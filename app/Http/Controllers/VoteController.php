<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    private $championsByRole = [
        'Toplaner' => [
            'Aatrox',
            'Akali',
            'Camille',
            'ChoGath',
            'Darius',
            'Dr. Mundo',
            'Fiora',
            'Gangplank',
            'Garen',
            'Gnar',
            'Gragas',
            'Illaoi',
            'Irelia',
            'Jax',
            'Jayce',
            'Kayle',
            'Kennen',
            'Malphite',
            'Mordekaiser',
            'Nasus',
            'Ornn',
            'Renekton',
            'Riven',
            'Sett',
            'Shen',
            'Singed',
            'Sion',
            'Sylas',
            'Tahm Kench',
            'Teemo',
            'Trundle',
            'Tryndamere',
            'Urgot',
            'Vladimir',
            'Volibear',
            'Wukong',
            'Yorick'
        ],
        'Jungler' => [
            'Amumu',
            'Diana',
            'Dr. Mundo',
            'Elise',
            'Evelynn',
            'Fiddlesticks',
            'Gragas',
            'Graves',
            'Hecarim',
            'Ivern',
            'Jarvan IV',
            'Jax',
            'Kayn',
            'KhaZix',
            'Kindred',
            'Lee Sin',
            'Lillia',
            'Master Yi',
            'Nidalee',
            'Nocturne',
            'Nunu',
            'Olaf',
            'Poppy',
            'Rammus',
            'Rek\'Sai',
            'Sejuani',
            'Shaco',
            'Skarner',
            'Taliyah',
            'Trundle',
            'Udyr',
            'Vi',
            'Viego',
            'Volibear',
            'Warwick',
            'Wukong',
            'Xin Zhao',
            'Zac'
        ],
        'Midlaner' => [
            'Ahri',
            'Akali',
            'Anivia',
            'Annie',
            'Aurelion Sol',
            'Azir',
            'Cassiopeia',
            'Corki',
            'Diana',
            'Ekko',
            'Fizz',
            'Galio',
            'Gragas',
            'Heimerdinger',
            'Irelia',
            'Kassadin',
            'Katarina',
            'LeBlanc',
            'Lissandra',
            'Lucian',
            'Lux',
            'Malzahar',
            'Neeko',
            'Orianna',
            'Qiyana',
            'Ryze',
            'Seraphine',
            'Swain',
            'Sylas',
            'Syndra',
            'Taliyah',
            'Talon',
            'Twisted Fate',
            'Veigar',
            'VelKoz',
            'Vex',
            'Viktor',
            'Vladimir',
            'Xerath',
            'Yasuo',
            'Yone',
            'Zed',
            'Ziggs',
            'Zoe'
        ],
        'Adcarry' => [
            'Aphelios',
            'Ashe',
            'Caitlyn',
            'Draven',
            'Ezreal',
            'Jhin',
            'Jinx',
            'KaiSa',
            'Kalista',
            'KogMaw',
            'Lucian',
            'Miss Fortune',
            'Samira',
            'Sivir',
            'Tristana',
            'Twitch',
            'Varus',
            'Vayne',
            'Xayah',
            'Ziggs'
        ],
        'Support' => [
            'Alistar',
            'Bard',
            'Blitzcrank',
            'Braum',
            'Janna',
            'Karma',
            'Leona',
            'Lulu',
            'Lux',
            'Maokai',
            'Morgana',
            'Nami',
            'Nautilus',
            'Pyke',
            'Rakan',
            'Rell',
            'Renata',
            'Seraphine',
            'Sona',
            'Soraka',
            'Swain',
            'Tahm Kench',
            'Taric',
            'Thresh',
            'Vel\'Koz',
            'Xerath',
            'Yuumi',
            'Zilean',
            'Zyra'
        ]
    ];

    private function normalizeChampionName($champion)
    {
        $champion = str_replace(["'", ".", " "], "", $champion);

        return $champion;
    }

    public function getChampionImage($champion)
    {
        $basePath = 'images/champions/';
        $formats = ['webp', 'jpeg', 'jpg', 'png'];

        $champion = $this->normalizeChampionName($champion);
        foreach ($formats as $format) {
            $imagePath = $basePath . $champion . '.' . $format;
            if (file_exists(public_path($imagePath))) {
                return asset($imagePath);
            }
        }

        return asset('images/champions/placeholder.png');
    }

    public function create()
    {
        return view('vote.step1');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'role' => 'required|in:Toplaner,Jungler,Midlaner,Adcarry,Support',
        ]);

        $voter = Voter::create([
            'name' => $request->name,
        ]);

        $vote = Vote::create([
            'voter_id' => $voter->id,
            'role' => $request->role,
            'champions' => [],
        ]);

        return redirect()->route('vote.step2', ['vote' => $vote->id]);
    }

    public function step2(Vote $vote)
    {
        $champions = $this->championsByRole[$vote->role] ?? [];

        return view('vote.step2', compact('vote', 'champions'));
    }

    public function storeStep2(Request $request, Vote $vote)
    {
        $request->validate([
            'champions' => 'required|array|size:3',
        ]);

        $vote->update([
            'champions' => $request->champions,
        ]);

        return redirect()->route('vote.success');
    }

    public function results()
    {
        $votes = Vote::all();

        $rolesCount = $votes->groupBy('role')->map(function ($roleVotes) {
            return $roleVotes->count();
        });

        $mostVotedRole = $rolesCount->sortDesc()->keys()->first();

        $championsCount = $votes->where('role', $mostVotedRole)->pluck('champions')->flatten()->countBy();

        $topThreeChampions = $championsCount->sortDesc()->take(3)->keys();

        return view('vote.results', compact('mostVotedRole', 'topThreeChampions'));
    }

    public function votersList()
    {
        $voters = Voter::with('votes')->get();

        return view('vote.voters', compact('voters'));
    }
}
