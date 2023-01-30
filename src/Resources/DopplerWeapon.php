<?php

namespace ConduitUtils\Resources;

class DopplerWeapon
{
    public static array $icons = [
        'Glock-18 | Gamma Doppler (Factory New)' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73dDBH_t26kL-GluX2P77YjG5V18J9herKyoD8j1yg5UU9YmulII6cJABoMlvU-FLoxe7m0ZHq7Z3NyiZm7HRxt3iPlkDmgxpSLrs4ffL9gek' => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZROjeXO9ofKhF2zowdyMWr6IYeQIwU8NFiGqAXtkr28jcO1vMvAnXRmuXQm5nuJnhKx1U5FOvsv26KW7OPGDg' => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZdOjeXO9ofKhF2zowdyZzjxcYLAcg85ZVvW81fqk-u615G4vpvBy3Vhv3VzsyvUyUfh1BEfOPsv26IorI3Qlg' => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZZOjeXO9ofKhF2zowdyMGGlLdeRIwA7YwuF_lbqxbq6057pu5_An3Jh7iQltHncnha01RkZZ_sv26Jen3bHMA' => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZFOjeXO9ofKhF2zowdyNj36d4TBJwRoNw3Y8lS8wO3phZa-v5XMmiQw73Uj4XaJyxe3gx1La_sv26Lb-wHJ3Q' => 'Phase 4'
        ],
        'Glock-18 | Gamma Doppler (Minimal Wear)' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73dDBH_t26kL-GluX2P77YjG5V18J9herKyoD8j1yg5UU9YmulII6cJABoMlvU-FLoxe7m0ZHq7Z3NyiZm7HRxt3iPlkDmgxpSLrs4ffL9gek' => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZROjeXO9ofKhF2zowdyMWr6IYeQIwU8NFiGqAXtkr28jcO1vMvAnXRmuXQm5nuJnhKx1U5FOvsv26KW7OPGDg' => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZdOjeXO9ofKhF2zowdyZzjxcYLAcg85ZVvW81fqk-u615G4vpvBy3Vhv3VzsyvUyUfh1BEfOPsv26IorI3Qlg' => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZZOjeXO9ofKhF2zowdyMGGlLdeRIwA7YwuF_lbqxbq6057pu5_An3Jh7iQltHncnha01RkZZ_sv26Jen3bHMA' => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZFOjeXO9ofKhF2zowdyNj36d4TBJwRoNw3Y8lS8wO3phZa-v5XMmiQw73Uj4XaJyxe3gx1La_sv26Lb-wHJ3Q' => 'Phase 4'
        ],
        'Glock-18 | Gamma Doppler (Field-Tested)' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73dDBH_t26kL-GluX2P77YjG5V18J9herKyoHwjF2hpl05Zj30dY6cI1RvZVnQ81Tsk-jsh5G-uZudwSY2uicl4Hbcy0figk1McKUx0sXxPu2g' => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZROjeXO9ofKhVGwogYxfT36ctOVJg49NQnV-1a7w7u-hZfqvs7AzyExvCcrty7YnxLhhR1MbexxxavJLr_JGgg' => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZdOjeXO9ofKhVGwogYxfWnxLYOXc1c2YFDQqwC3x-zsjJ_pvMvAmiNkv3MltCvfm0HiiRxFZ7dxxavJ2PGuWkU' => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZZOjeXO9ofKhVGwogYxfWDydYeSewdtM1HS_1joxezojcC8uJvLwCRiuiUl5SzVzBC-gB9EaLRxxavJHIemcQo' => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZFOjeXO9ofKhVGwogYxfWvyd4-WdAA7Z1GE81K6yOa-gcLtuZjNwCNquHV2tCmPn0G1gxwZauRxxavJyTh7h00' => 'Phase 4'
        ],
        'Glock-18 | Gamma Doppler (Well-Worn)' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73dDBH_t26kL-GluX2P77YjG5V18J9herKyoHwjF2hpl05Zj30dY6cI1RvZVnQ81Tsk-jsh5G-uZudwSY2uicl4Hbcy0figk1McKUx0sXxPu2g' => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZROjeXO9ofKhVGwogYxfT36ctOVJg49NQnV-1a7w7u-hZfqvs7AzyExvCcrty7YnxLhhR1MbexxxavJLr_JGgg' => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZdOjeXO9ofKhVGwogYxfWnxLYOXc1c2YFDQqwC3x-zsjJ_pvMvAmiNkv3MltCvfm0HiiRxFZ7dxxavJ2PGuWkU' => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZZOjeXO9ofKhVGwogYxfWDydYeSewdtM1HS_1joxezojcC8uJvLwCRiuiUl5SzVzBC-gB9EaLRxxavJHIemcQo' => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZFOjeXO9ofKhVGwogYxfWvyd4-WdAA7Z1GE81K6yOa-gcLtuZjNwCNquHV2tCmPn0G1gxwZauRxxavJyTh7h00' => 'Phase 4'
        ],
        'Glock-18 | Gamma Doppler (Battle-Scarred)' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73dDBH_t26kL-GluX2P77YjG5V18J9herKyoTwiUKt5RJsZ2mhJNCcdwJsaFnR_QO8w-7mhJa_vcvPmiBhu3Jx4ynZzRK21ElSLrs4ssFJ1N4' => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZROjeXO9ofKgFG1vQpyYGj7cNKXeg45ZQnQ-ADtlezn18e4vpzPznFq63Mh5nvUzkHk1BgZaPsv26I8PUIW6Q' => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZdOjeXO9ofKgFG1vQpyYzr2JdSRdwQ7ZgnX-le7yerm0ZXtupjOnXM27iAl43bZyxWz0koeOvsv26JJj9qWmg' => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZZOjeXO9ofKgFG1vQpyZWzxIoedeg86YwuE_VG2ybrphcC8vZ3PnSdjvSEk4yyOnhXhhxpPavsv26KvkfsnQA' => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgposbaqKAxf0v73djxP4d2JkI-bh_vxIYTBnmpC7ZFOjeXO9ofKgFG1vQpyZGrwLYKdJ1Q2NVzV_1Xql-vq05G-tJycziBruCd25nzYnhC3gk4fZ_sv26KXCstvKA' => 'Phase 4'
        ]
    ];
}