<?php

namespace ConduitUtils\Resources;

class DopplerKnive
{
    public static bool $hasStattrak = true;

    public static array $exteriors = [
        'FN'    => '(Factory New)',
        'MW'    => '(Minimal Wear)'
    ];

    public static array $icons = [
        '★ Gut Knife | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP09m7kZKKm_PLPrrDlGdU4d90jtbN_Iv9nBqxqRU5MG32ddeQIwdsaVqE_wTtkO66g5Hv7p6fzHprvidx4XiLzBezn1gSOQvdpryG'                          => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP09u3mY2KqPP7I6vdk3lu-M1wmeyQyoD8j1yg5RI9YzymItKRcQY2YFyC-Fe7x-3p05K8uMybwXdmvyN34n6LnBGygUxSLrs4hchk9Mk'                       => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP09u3mY2KqPP7I6vdk3lu-M1wmeyTyoD8j1yg5RZrazv1J9fGJgRvNF_W_Afolefs0Z6_uJSaznM36yInt3rbnRW-iB9SLrs4UCqX9kU'                       => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP09u3mY2KqPP7I6vdk3lu-M1wmeySyoD8j1yg5Rc5Ymz1I9DDJgdtZgnZq1e4xrjrhZe6uc7MmyFr7HUqsCrZlhG3hUxSLrs4Ij6o7R8'                       => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP09u3mY2KqPP7I6vdk3lu-M1wmeyVyoD8j1yg5UU9Ymr7JoOUIQI5N12G_la_x-rs1pe0v5-bzHFh7HMg5yrVzRfi0E5SLrs49eTjEI8'                       => 'Phase 4'
        ],
        '★ Gut Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP0966lYOAh_L1Ibfum2pD6sl0g_PE8bP5gVO8v11tZzqhLYGRIw86aQ2G81i3k-bog8XptcjIynFi7CB3sH6Jzh2_1BlFcKUx0ncN5NuB'                      => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP09i5hJCHkuXLI7PQhW4A18l4jeHVu9703Azs-hA_MTuncNWWIVU-aF7Z_1a7k-bo0cW_v8_OyXVqvyAqsy3D30vgdDGy9vw'                               => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP09i5hJCHkuXLI7PQhW4D18l4jeHVu96tilbtqEFrZT_3IYXBcgA4Z1_V_1e5wunu1pC6upucm3Zqu3EgtH7D30vgYyt-jDc'                               => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP09i5hJCHkuXLI7PQhW4C18l4jeHVu9Wt2Qbjrko6N2ulIIKXJAZqNFnU-lbsk-3t0Za77siYwXUwviMm5HrD30vgjkYaISA'                               => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP09i5hJCHkuXLI7PQhW4F18l4jeHVu4j22Q3hrUo_Zj2hdYeSegM9NFyCqADtyLvq0cW8v5rLwHViv3IgtynD30vgrLbjMOA'                               => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP086jlpm0mvbmMbfUn3FU7Pp9g-7J4cKm2QHiqkY6ZGD1LIfEJlA6MFqG8lG7lLy70ce7vcufzCBis3EksSregVXp1kbC88_z'                              => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1ObcTjxP08-3hJCDnuXxDLbQhGld7cxrj-3--YXygED6_BVlZDv3IYLGJAE2aQvX_wW5xLzrhsDqvp7Pynpkv3Ui7XnUzhHmhAYMMLIU9_4nhg'                        => 'Sapphire'
        ],
        '★ Navaja Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1OrYYiR95t21n4uFnvHxDLrcqWld6cZ6muzA54DKhVWmqR85OiOmcOnJK1FmJUbT-gS4kLvqgZC7vc_NwCcy6yVzti7fykCxhUpKPeM61PLLH1yYVvFLAuDcUZQuw8Lo'      => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1OrYYiR95t21n4uFnvHxDLrcqW9e-NV9j_v-5YT0m1HllB81NDG3OoeScgM5aFDSqVbvlLjth8K_6MzOy3dl6yRz7Czemx3ihhhEabQ716OACQLJ_piUbl4'               => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1OrYYiR95t21n4uFnvHxDLrcqW9e-NV9j_v-5YT0m1HmlB81NDG3OoaSI1M4M1iE81jrxr-51Je_v52dyHoxvicm7C6OmBy0hU5IaOQ9hfOACQLJ1793rRA'               => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1OrYYiR95t21n4uFnvHxDLrcqW9e-NV9j_v-5YT0m1HnlB81NDG3OoOUdAA2YFmCqVfsw7rmhsfp6p3JyHBk6XInt37UmxTjiBxPO-M61qSACQLJmN5shCI'               => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1OrYYiR95t21n4uFnvHxDLrcqW9e-NV9j_v-5YT0m1HglB81NDG3OtCTclNqZAvR-1bvle7s0ce1uZXOzXZksiF04Xbamkay0ElPa7RohKCACQLJjXZ8CxQ'               => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1OrYYiR95t21n4uFnvHxDLrcqXlE6txOh-jT94DwgU6xrywwOj6rYOnJI0RpNEbXqAe6we7ng57v6cvOwCZlsiZ34HvZyR2-gE1NbedrhvGeTwnMA_YYAuDcUQ6d7LrR'      => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1OrYYiR95t21n4uFnvHxDLrcqXhQ-NV5g_vEyoH0mla4rhomNj2ceN_CKkIgYwrW_QTvlOi6gpTvtc-YzHJl6yQl7XqPmxHi101Lbuxo1PSYTVqdUbsJQvdde5AbFA'        => 'Sapphire'
        ],
        '★ Shadow Daggers | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOzmYWZlvvwDLbQhGld7cxrj-3--YXygED6qkA-NWzxJ4SUdQ4_MA7W_we2k7-6h8C47cnJnCZl7CNw7XfZy0DmgQYMMLJ5F90kuQ'                        => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOxlY2GlsjwPKvBmm5D19V5i_rEpLP5gVO8v11rMD32co6ddgBoZwvUqwS6wbi71MO6v8jPm3NjvCAl43uPmhS2hRhNcKUx0tlEWukr'                      => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOxlY2GlsjwPKvBmm5D19V5i_rEp7P5gVO8v11lZmn6cICSJ1A6Nw2DrgS-l-bphpS578uaySAx73UisCuPlhW_hhhFcKUx0kWzyDYX'                      => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOxlY2GlsjwPKvBmm5D19V5i_rEprP5gVO8v11vYmH6d4SccgM_NQuCrwTvw-vthZ606M6fnyZlvycg5HmMnETihh8YcKUx0p06CbW0'                      => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOxlY2GlsjwPKvBmm5D19V5i_rEobP5gVO8v10-ZjilLIKXdAc4YlrYrle7ye3rhpLq6pScnHJrvSgg7SzdnxDi10pFcKUx0uJ4WFiZ'                      => 'Phase 4'
        ],
        '★ Shadow Daggers | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eO0mIGInOfxMqndqWZQ-sd9j-Db8IjKimu4ohQ0J3egJYCRJwNtaAnZqFbswunp0ZS_7Z_MyXpi7iknsXeJyxa3ghhJbOw5m7XAHiOIIXZS'                  => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOym5Cbm_LmDKvZl3hUufp9g-7J4cKg3AXgrxJkZzqgcdTEcg5sY1mEqQXsk-3q15G76pnKmnFmsikg5CqMgVXp1pw20OEp'                              => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOym5Cbm_LmDKvZl3hUuvpzteXI8oThxgHl_RdqMD_2cYeTIQ84ZQuE-VTsye3m1JTutM_Pn3Rh63Qn43vdlxapwUYb4JkLank'                           => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOym5Cbm_LmDKvZl3hUu_p9g-7J4cLzjgW2-ktvZT_6dYfAdQI8YluE-wDtxe2505Do6Z_Oz3Rg7CJx5nqLgVXp1nwmojSb'                              => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOym5Cbm_LmDKvZl3hUvPp9g-7J4cKg0AyxqUM4NWn0JIWWIAY6NVnQrAftxr3mhJHqvZmbySRgs3Mq7XmOgVXp1nQeST2E'                              => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOkgYKSqPr1Ibndk2JL7cFOhuDG_Zi7jAW3-RduYW_zJ9CTIQJoaQ7UqVm4l-_m1p6-6JqdznA27yMitnrZmgv3308wVSkT7w'                            => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfw-bbeQJD4eOllZCbn_7mNoTcl3lT5MB4kOzFyo7KhF2zowdyY2n7JoeddAZrZl2B_Fe2x--90MfuuZjLn3Ayv3N2ti2JnRGy0hAeaPsv26KMy01uWQ'                    => 'Sapphire'
        ],
        '★ Falchion Knife | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20kvrxIbrdklRc6ddzhuzI74nxt1i9rBsofWH1doORcwA3MgnQ-gLokOrnh5G9ucjNwCBmvyh37CramxKwh0lKaOxxxavJ5nr2zp0'                   => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQWLpxo7Oy3tIIGRI1c5YQuG_VO9xei50MO1tc-YnXRmvXEgsX3aykezhh9KaeM60eveFws9D4cWAA'                => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQaLpxo7Oy3tLYWSJgc4ZFjZqAK_xrzv0Z_ttJqdm3RlvHMm4nfbyhHj004dOONrjOveFwuZHI8k3A'                => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQeLpxo7Oy3tJY_BJw89MlCE-AXvyO--g5PutJ7OnXFnvXQgs33Vy0CzgR8aOOU6guveFwvCZXjyiA'                => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQCLpxo7Oy3tI4aSdQU_MAnV_APsxunvhsftvc-YyyNjuCAn7X2LnBTjhhtPZ-dugOveFwuBLOuZXA'                => 'Phase 4'
        ],
        '★ Falchion Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20lfv1MLDBk2pD5Pp8i_vD-Yn8klGwlB81NDG3OtDAcgM4Mw6GrwS3kOjn15Hv7ZnBmiFjvCcr5y2OmhC_h0wdPbZth_WACQLJOWkAmeM'               => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20k_jkI7fUhFRB4MRij7j--YXygED6_kZvZDryJoDHegU4YA2DqQC9wO_mgJe-vM6bwHBlviJ05HjblxC2iQYMMLJU9KLVJA'                        => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20k_jkI7fUhFRB4MRij7v--YXygED6_0M4YGr2dY6VJ1NoaArR-gK4yOu6jJ-8u8yYmydk7nErt3iJmBWz0gYMMLKkrq5FpQ'                        => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20k_jkI7fUhFRB4MRij7r--YXygED6-0RtYTr7I4LDcwJvMlnXrwK4xe_sgsK66JWcnXJj7nUj5HffnRHmggYMMLJlW7phRA'                        => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20k_jkI7fUhFRB4MRij73--YXygED6rkQ6amD3J9eUJw5raA7T_1TvyLrtgcK-vJjOwSNivSUi4n3eykO-iAYMMLJ7lIc8Bg'                        => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20heL2KoTcl3lT5MB4kOzFyoD8j1yg5RZrYjr6JY-cJgA5Zw2CrlPqxeu8hZK77c7NznA2uiFw4SyOmRfkiRpSLrs48wN4FN8'                       => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1fLEcjVL49KJlY20hPbkI7PYhG5u5cRjiOXE_JbwjGu4ohQ0J3f6cYSWJAY8MAvV-1G9lO66gZW16pvIySFquichtHuIlkGy0xxPb7M9m7XAHmOSF-ns'                  => 'Sapphire'
        ],
        '★ Bowie Knife | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbuk2ZU-sR9jtbM9J73hFG9sRY4DDWqc97RbFc9YQrZ_wC_kOno0ZO96s_AwSQ3vHQh7H_amR220B1Ea7RnhaPKGlWAR_serzi61cA'           => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbukWpc5cROjubR5YDwmmukoxIvNmiceN_CKkIgZw6Fq1K9k-_t05G5tJvAzScxv3Eq4i7ZzRbmh04Za-1sjaecHV7KVrsJQvcbhZ35iA'        => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbukWpc5cROjubR5YDwmmukoxIvNmuceN_CKkIgMAzV-lHtw-vpgZfv7pWYnHA3siIl7HfblkGygxwePexvjaCcHQjNU7sJQvdlS3pkbA'        => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbukWpc5cROjubR5YDwmmukoxIvNmqceN_CKkIgYVqE81S3lO3rhJG9u5_MznJksiQq7X-Jmh3j1U5LarFngvCbSw-dUrsJQveUCQ3rrw'        => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbukWpc5cROjubR5YDwmmukoxIvNm2ceN_CKkIgNAzW_lC6yem90ce-uprOy3JrvCQh4n-MmEGz1UkZb7A6h_DKTQ3IA7sJQvcIfk_yQw'        => 'Phase 4'
        ],
        '★ Bowie Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbulGdQ685hj-jT-bP4iUa2pxY1KTynS9rMJV56fwzW_1bryevohMLv6siYmnNn6XQr7CndzEa2h0tKardshqGZTV2bUq1XXP7VSLu9WCk'       => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbukmRB-Ml0mNbR_Y3mjQWLpxo7Oy3tJI6ddwM-aQ7S_VW-w-a8gcDuvZrKz3Rl63F05X7UyRGziRFJa-xvgeveFwsmoJhDFQ'                => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbukmRB-Ml0mNbR_Y3mjQaLpxo7Oy3tI9eRd1I7aA6G8ge_lOi-1pW6vsnLzyNjviRw4Hnfl0eyghFPa7FsgOveFwvj2l7OdQ'                => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbukmRB-Ml0mNbR_Y3mjQeLpxo7Oy3tJtOVe1dsY1nUqAO_kua5hZXtuMybmHtivHZz5ivdl0DkhB4aaONp0eveFwvzsJ5Rmg'                => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbukmRB-Ml0mNbR_Y3mjQCLpxo7Oy3tddTAelc7aV6D-gC6lebtgpO8vp2YznBnv3Ug5CyLmBHh00wea-Vv0eveFwtL59uOfw'                => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbuhH5T8fp8i_vD-Yn8klGwlB81NDG3OtDDewY6aF6G_la_wejpgcTpvMmcwHBqu3Qi4XjdnRO21ExFOLZng6GACQLJb0FpVsg'               => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwObaZzRU7dCJlo-cnvLLMrbuhWpB-M14mOz--I3nilixogk5NwavfdHNNhhrM12E8we8k-7pgsTtu53Pm3Jl7HQksC3eyh22g0tEaOFr1KTIG13IGeUXS7HreSzp'          => 'Sapphire'
        ],
        '★ Huntsman Knife | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20kvrxIbrdklRc6ddzhuzI74nxt1i9rBsofW3wdoDBcwE8aVzU_1nowbq-gsPv6Z-dziFj6yZ24n_elkG10B4YZrZxxavJsSrz0Wc'                   => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQWLpxo7Oy3tLYDBJFRoZlvX-VG7xOe70MW06M_AznBnsyEj4ivfnEG20EpPbrY50eveFwtFtzoVzg'                => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQaLpxo7Oy3tcIPEIFU4MFzTrli2lOzu1pe-vsjNyiRg7CFx4C7Ulx2x1xFLPOA6h-veFwvfJ1lAug'                => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQeLpxo7Oy3tJ4fHewE2Y1jYrlm9wezvgpfquZ_NzSQw6CEh5XuIzhG_hkwaO-M6jeveFwtlaDxDLg'                => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQCLpxo7Oy3tddSXIAQ4ZAvS-1i6kuzmjcLqus7IzXtjsiIm7Xfdmke2hhweb7Zq0-veFwsVkDh1MQ'                => 'Phase 4'
        ],
        '★ Huntsman Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20lfv1MLDBk2pD5Pp8i_vD-Yn8klGwlB81NDG3OoWQJgFtaF-D_lK-kr3t15Tuv8jAmnJn6Ccj4yzenBPh1U1FPOM606eACQLJCUKwlNc'               => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20k_jkI7fUhFRB4MRij7j--YXygED6-0Q-Z2umLYGddVc5ZlnU-QXowr2-08O9tZ_JyyAys3Jz4ivUnxK3hwYMMLKe5XXxtg'                        => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20k_jkI7fUhFRB4MRij7v--YXygED68xFta2z0cYOWIVJqMF7T-Fi2xbvojcLtv5zAwXNnsnYr4naPzhKygQYMMLKHPHTzSA'                        => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20k_jkI7fUhFRB4MRij7r--YXygED6qUVkNW_3IYCXdAc4ZwvZ8wTql-3vgcTq7cnOnXM1siUj537UnBblgQYMMLKO8np86Q'                        => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20k_jkI7fUhFRB4MRij73--YXygED6-xBrYzv7dtSVcgM6YgnZ_1S_k7q6jMS8vJrPnCY1uCBztyqLmUey1wYMMLLSJ9t1zA'                        => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20heL2KoTcl3lT5MB4kOzFyoD8j1yg5UZqMTj7ctOUIAY5YVHY-QO_k7vthpC5tcjAznti6yMn7HmLy0Th1RpSLrs4PnCsPQE'                       => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfx_LLZTRB7dCJlY20hPbkI7PYhG5u5cRjiOXE_JbwjGu4ohQ0J3enddfGcFI4Y1_T-ljvkObp0ZLqvZrAzXthsnYh5CqPzEO00hxKae1rm7XAHud_L0L0'                  => 'Sapphire'
        ],
        '★ Stiletto Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwOfBfThW-NOJlY20lfv1MLDBk2pD5Pp8i_vD-Yn8klGwlB81NDG3S9rEMFFrf1HVqVe7xO_t1pa_v5vInSM2v3YgsH7cmhTliB1KabFphPGcT1ifVPBXXP7VfnqMvnE'       => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwOfBfThW-NOJlY20k_jkI7fUhFRB4MRij7j--YXygED6_kptYWmnINDAe1U_MFqE-AK8kubsgZC6vZTBy3dm7iAjty6OmRG0gAYMMLJXF6TfvA'                        => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwOfBfThW-NOJlY20k_jkI7fUhFRB4MRij7v--YXygED6_hZvNmH6dYCTIQQ9Ml3XrwTvwLi615K46s_Pmns1uXJ34SnYmBKw0AYMMLKAKIcTNQ'                        => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwOfBfThW-NOJlY20k_jkI7fUhFRB4MRij7r--YXygECLpxIuNDztcIOTdQQ7YwzSrlC-xua5gJe0vZWczXNnuHJ3tyzVmhC-gUoaPONt1OveFwse7jCorA'                => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwOfBfThW-NOJlY20k_jkI7fUhFRB4MRij73--YXygED6-0RoMWr3I9XAIQY9Mg6G-1e7krzq0Za06JSdznY1s3F3sH6OyR2-0gYMMLJWWwFisg'                        => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwOfBfThW-NOJlY20heL2KoTcl3lT5MB4kOzFyoD8j1yglB89IT6mOtXAI1NoNVzYq1e_xe-6jZ_ov5jBmnZiviEqtyvYmBW3h0tLbeE9gv2ACQLJoLokP7k'               => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfwOfBfThW-NOJlY20hPbkI7PYhG5u5cRjiOXE_JbwjGu4ohQ0JwavdcTCJxg9ZF_WqADsyOm715Lpu5SYySFiuCV07XnczhGyhUlMPeI-16CWSl6cGeUXS8Mn9SuW'          => 'Sapphire'
        ],
        '★ Flip Knife | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOzmYWZlvvwDLbQhGld7cxrj-3--YXygED6-UBlZWGiIICVdQBoZFHR-Fftk7y8hsTotZjAmiFhuil2ti6ImkCwhQYMMLJIJJ_2Qw'                        => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOxlY2GlsjwPKvBmm5D19V5i_rEpLP5gVO8v11rMT_6JtWUcwE2ZVmF_1S9wurv18W5752dyXBlvHNw4XrVzRy1gxxFcKUx0qdLIRFw'                      => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOxlY2GlsjwPKvBmm5D19V5i_rEp7P5gVO8v11lN2v2Io_DIwI3YQyC_FHqyezvhMS8v5_OyiRguCMgtHzczBWy000YcKUx0nna_20E'                      => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOxlY2GlsjwPKvBmm5D19V5i_rEprP5gVO8v11vZD_6cIeWdwI_Mw7Y-QK6lbztjJ7u7sjJznQ2uyUq4S7bnhzl1xxLcKUx0mona-Mb'                      => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOxlY2GlsjwPKvBmm5D19V5i_rEobP5gVO8v106MWH0IYTDdgU2ZQuE_lS8xb3vhsW1uM-YzHY3vyF25HzfnhOw0xFNcKUx0ilo-Uy6'                      => 'Phase 4'
        ],
        '★ Flip Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eO0mIGInOfxMqndqWZQ-sd9j-Db8IjKhF2zowdyZz_yLIfGdAFvYguD-Fa9kOrp15G9vpifz3A26ycjt3qMzBDig05Lafsv26IspbmNiQ'                    => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOym5Cbm_LmDKvZl3hUufp9g-7J4cKj3FK2qEpvYmH7ddSRdVVvMFDTqVfsk7q6h8C_tZnJzHRh7CFw53zagVXp1vI5Ejry'                              => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOym5Cbm_LmDKvZl3hUuvp9g-7J4cKn21Lg-UtsZzunJNCcdgQ9Zg7T-QS6wLu5h5e4vZXAzno16CQr4HnegVXp1j8d9SMm'                              => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOym5Cbm_LmDKvZl3hUu_p9g-7J4cL23g3sr0Y4ZTihdteccwJqaViE-Fi8lby9hpbq6c_KzHMyvSYqs3zegVXp1mfvJpRH'                              => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOym5Cbm_LmDKvZl3hUvPp9g-7J4cKm2VKy-0JvMWihItfAewRtN16F_gK3xu7vgsLo7ZjLzCBkvSYqsyuJgVXp1k9_xjt3'                              => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOkgYKSqPr1Ibndk2JL7cFOhuDG_Zi7jgLtqkVpZjrwJNKSdVVrMl7U_gLvw72-0Ze5u56bnXJgsyBws3bblgv33087zklSXg'                            => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf1f_BYQJD4eOllZCbn_7mNoTcl3lT5MB4kOzFyoD8j1yg5UBuazj3cYKQJwA5ZwnVrla_yLi5hcPp6szPwHZqvnVx5n_Vyhzjgh1SLrs4EHv5ZcQ'                       => 'Sapphire'
        ],
        '★ Ursus Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxuHbZC597dGJloyKlPzkNrrDmlRc6ddzhuzI74nxt1i9rBsoDDWiZtHAbABtaA3Ur1m2xei8gZa675-dmCNisyAn7Srelhzi0EtMbrA5hPCWSlmAR_seEnS5DqI'           => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxuHbZC597dGJkI-bh_vxIYTBnmpC7ZROhuDG_Zi7jQWy-UFqN2r7INDDdAVsMAmD8lLql7vvhJPq75jLzXYysnIn7XbVmQv3309_tWjVng'                            => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxuHbZC597dGJkI-bh_vxIYTBnmpC7ZdOhuDG_ZjKhFWmrBZyMG_wIoCQdQU-NFzY-li2x-vrg5O86s_BwXprsnEhtHndnkDl1Rgaafsv26JiRVPr0Q'                    => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxuHbZC597dGJkI-bh_vxIYTBnmpC7ZZOhuDG_Zi70FbnqhVkMG7yJISQelc7N1rW-VW2yObngcS_78iazyA2vXYqsXjazQv330_A0SwGew'                            => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxuHbZC597dGJkI-bh_vxIYTBnmpC7ZFOhuDG_Zi7jgWw_hJsYjygIYDEdFdraV2FrFfql-jo05bvv5ibzXFjsiYn7XbVmAv3309R3fUXZg'                            => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxuHbZC597dGJhpWJjsj5MqnTmm5Y8sB1teXI8oTht1i1uRQ5fT36ctKUewZsYVDT_QToxLvrjce8tJ7KwXNq6Scm5C3ZnxS0ghsaauBxxavJr1eE_Rs'                   => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxuHbZC597dGJh4Gbh__9Ib7um2pD6sl0g_PE8bP5gVO8vywwMiukcZiUdVI_ZwmC-Fa-xb_ujZW7ucycyXZg6Ckn4HaIzUGz1BtPauNu1vOZVxzAUD4jS_xv'              => 'Sapphire'
        ],
        '★ Bayonet | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJH4dmklYyPqPr1Ibndk2JL7cFOhuDG_Zi72VDh8kduZW37JIeWJ1Q9Yl2G8gToxrrmhpfvtZ6YynI1siRw7HbVmwv330-du9HHOA'                            => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJF7dG7lb-PmOfkP77DqXtZ6dZ029bN_Iv9nBrk-RE-NTygJYOdcwdsMlnW_Vi6xufuhZHt6p2an3cwvCYn5yrZn0O2n1gSOaR__zxS'                          => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJF7dG7lb-PmOfkP77DqXtZ6dZ02NbN_Iv9nBq3rRBsNzv1LdXBIwI5YgqFqVi3kL3shJW578nAynU3vHZ34imOmRCzn1gSOeA4WWgj'                          => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJF7dG7lb-PmOfkP77DqXtZ6dZ02dbN_Iv9nBrmrkFqYD_xcI_GcQ5rYg6DrAO6xL_mgJ_uvZ2YnXtq6CJ34nqPmkS2n1gSOSUsT3Uj'                          => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJF7dG7lb-PmOfkP77DqXtZ6dZ03tbN_Iv9nBq2_kJkZWr6cISWcw9sNAvZqFHrwOu70Mfq7ZvKmHBnuXUmsHrcn0Swn1gSOXxc-0BQ'                          => 'Phase 4'
        ],
        '★ Bayonet | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJA4N21n5COluX4DLbQhGld7cxrj-3--YXygED6rxVtMWmgJ4fDJ1U_aA6EqFC5w7vujMO9uJrIzCdg6HMgs3mMlxe-0wYMMLLYtmuUHw'                        => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJG48ymmIWZqOf8MqjUx1Rd4cJ5nqeT8Ymi3wzt-UNrZ2mmItWRcgRvM16BqVK4l7jq0J-4vZ3IwHQ16HUq-z-DyALmsiWI'                                  => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJG48ymmIWZqOf8MqjUxFRd4cJ5nqeW946n0FfgrRFqYWulIdSVdAI5NAqC-Fa2kOvv0Z-9vJ7KmidquCQr-z-DyAl0eh_q'                                  => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJG48ymmIWZqOf8MqjUxVRd4cJ5nqeXpdzx0FHgqhFqZmn6IY_DI1U8aFuB_FLql-nt1pe7tMybzHFmvCUj-z-DyAETkzcY'                                  => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJG48ymmIWZqOf8MqjUwlRd4cJ5nqeR9Iqt2gyw_xZlN2z3LNXDcgc9Y1CBqVLrkLvsjcDu7picmHJguiZ2-z-DyMqcL4Vk'                                  => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJQ-d6vq42KhfX4NrLLk29u5Mx2gv2P9o6njA3mrxVrNm2iItXAdAY7ZFuEq1e2wri-gsTousjBn3Nqs3Fw5GGdwUIbpPL9uQ'                                => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpotLu8JAllx8zJfAJR7cymnImZksj5MqnTmm5Y8sB1teXI8oThxlHtrkNoMWyhItDDcFJoaFjW_Vm7yL2-18W6uc6ayHcwuCQntH-Om0SpwUYb_FLG0qs'                           => 'Sapphire'
        ],
        '★ M9 Bayonet | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjxPr7Dl2dV18hwmOvN8IXvjVCLpxo7Oy3tIdLEdgdqNAmBqFa_kO3mh8K9uJqbyiMy7HIn5H3VzUPl1B0dO7M7hOveFwvYitsMFw'                => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjzMrbcl1RV59VhhuzTypz9iUex-iwwOj6rYJiRew4-MgrSqAO-yLvujMe4tMzJzSM2uylz5SrbnBC0hRpKO-1u1qbLVxzAUNEUr2p2'              => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjzMrbcl1RV59VhhuzTypz9iUex-SwwOj6rYJiRcg8-Z13Trlm5w--60ZS96szJzidn6ygi5yvamUPk0kxJb7E6hqaZVxzAUK6TGQbC'              => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjzMrbcl1RV59VhhuzTypz9iUex-CwwOj6rYJiWdFQ7N1DS_Fa3lOvv15a578-ayCRr7nRw5SuMnUS00BwYOrNvgfSYVxzAUKnD8K-k'              => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjzMrbcl1RV59VhhuzTypz9iUex_ywwOj6rYJicIQ9qYArT8wO8yLzq1pK0tJ6dnyFhviUm5yyJykSzh0oePOI7h_yZVxzAUMOxo1og'              => 'Phase 4'
        ],
        '★ M9 Bayonet | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-Kmsj2P7rSnXtU6dd9teTA5475jV2urhcDPzCkfMKLIwRvYwrWqVS8wezpjcS_78_Mn3Bruykj7HbfzhPm00xLOLc-jPXNHELeWfLcbrqw2A'            => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjwPKvBmm5D19V5i_rEpLP5gVO8v11tMmD6IobEdFRsMFmB8lPvlL-9hZbuvJ_JziBn7HYltnvfnES21xhKcKUx0sfosVEP'                      => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjwPKvBmm5D19V5i_rEp7P5gVO8v11uaz_7d9SRcQM-ZlCG-lS3x-_s0Je56JrMmCFnu3Yitnjby0Cx0B4acKUx0j6jkldx'                      => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjwPKvBmm5D19V5i_rEprP5gVO8v11lZj-gIYbDclRqMA7Zq1S7lOm-0Za6753KmHoxvnQh5y7ZyhWxiRwecKUx0iL1oy6z'                      => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjwPKvBmm5D19V5i_rEobP5gVO8v11kZTr6cdDAIVA5ZA2GqVW3x7281sftvZ_AzXZmv3Mm5H2LlxWw1RhIcKUx0uHVWO7n'                      => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjmJrnIqWZQ-sd9j-Db8IjKhF2zowdyYzjyLIGSIAA8YguCqVK9lOa-1JW5vprBz3EyviB07SveyhfkhklNP_sv26JLM0iiyQ'                    => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjnMqvBnmJD7fp8i_vD-Yn8klGwlB81NDG3OtSUJgY7YVvS-VfolLq7hsO5tZ_OnXo3uyhz7SyPnhGx0xoeb-dugKOACQLJ28w8Lgw'               => 'Sapphire'
        ],
        '★ Talon Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxPrMfipP7dezhr-Kmsj2P7rSnXtU6dd9teTA5475jV2urhcDPzCkfML6Lld8Ng3O_AO4lbu908K0uJyYyXtiuSN34XiPnkTh1BlFb7E80PyeSF2dB6AbHb7CWCSD7XOwiQ'    => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxPrMfipP7dezhr-KmsjwPKvBmm5D19V5i_rEpLPigVC7vCwwOj6rYJiWdw87NFyB-wfqxLq5h5PtuJudyHU36SR25i7blkfmiBsYOOc-gvLPVxzAUHaSd1K1'              => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxPrMfipP7dezhr-KmsjwPKvBmm5D19V5i_rEp7PigVC7vCwwOj6rYJjBcAZvNFvTrFC_l7-5jJbvtMnMyHtrs3J27SqLlhG010xJOLM5gvyZVxzAUE0LMc1E'              => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxPrMfipP7dezhr-KmsjwPKvBmm5D19V5i_rEprPigVC7vCwwOj6rYOnJI0RpNEbVrAXvlOi8gcDtvZrJziA1vCAqt3-MyRHm0hoYaec-1_3PQF7NVfNIAuDcUWvXnfMD'      => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxPrMfipP7dezhr-KmsjwPKvBmm5D19V5i_rEprPigVC7vCwwOj6rYJiQJFJvNF6D_gfvwOnvgsTqup3Bm3Iy7CRztn2JmBfm0xAdZ-c816OfVxzAUCeK9YIM'              => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxPrMfipP7dezhr-KmsjmJrnIqWZQ-sd9j-Db8IjKhF2zowcDPzixc9OLJ1I2NFjV-Vi_lOjm0JfovM6dnScw7yIj4yrdyRy20B1PZ7Q5g_HIGELeWfJNclpFPg'            => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJfxPrMfipP7dezhr-KmsjnMqvBnmJD7fp8i_vD-Yn8klGwlB81NDG3S9rEMFFrf1DTq1jvkOm-18Dq75_JmyY2s3Qg4iyMmRSx1EoeZ7drjfDMHFvMAKBXXP7V39YwYi0'       => 'Sapphire'
        ],
        '★ Karambit | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20kvrxIbrdklRc6ddzhuzI74nxt1i9rBsofT-ld9LDJgVsY1nX-QLtlejqg5bu7Zydm3Q1uSVzsXmOmUe3ghFKauBxxavJdWR7Gog'                   => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQWLpxo7Oy3tI4CcIVA8MArW_VfrkOy-gsK7v5_LmnBmsnYn4i2MzB3j0klMbuZsg-veFwtNHI-dng'                => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQaLpxo7Oy3tcYKVcQRsZF_Q-FTow-zs0Jft7czNmiNluyV35nrbyR2_1UlPaOFp1uveFwtI0RP3qg'                => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQeLpxo7Oy3td9LDIQZtYVCE_FS8x-fqjZ_vv5mbnHZq7nN25yrdzR221BlFbew7jeveFwu1r0V1Rw'                => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20kPb5PrrukmRB-Ml0mNbR_Y3mjQCLpxo7Oy3tddKScVVvYVzQq1a2lb2615Hu6p7OmHNluCdzsSvazkSyghBEOLNuh-veFwtgyyI7Iw'                => 'Phase 4'
        ],
        '★ Karambit | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20lfv1MLDBk2pD5Pp8i_vD-Yn8klGwlB81NDG3OtWTJAdsNVCG-Vjvwrvsh8Dv6szBznVivSMnt3eOlx22hhhNbu1o0PaACQLJyiL9rI8'               => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20k_jkI7fUhFRB4MRij7j--YXygED6-kU_Y2HyLYaXeldoZFHYqFa5w-btg8W-7s7PzndkuyJz5CvYzkO0hgYMMLK4xIyRWw'                        => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20k_jkI7fUhFRB4MRij7v--YXygED6-BZpNTqicoWXcQ43aV6Br1DqxL--jZO_7svAzXs3uCQg4XyLmhXhhQYMMLKBF8xkUA'                        => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20k_jkI7fUhFRB4MRij7r--YXygED6-EtrNmihLYaXIQ83Nw6C-1C6k-zvgMO7up7NmHs2uykl43fYnUG3hQYMMLINmYZu2g'                        => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20k_jkI7fUhFRB4MRij73--YXygED680pqMjr0IdeUd1drYFnR_QK2x73qg5G-uczMyntmvHYjsSrezhbh0wYMMLJgYOl_1g'                        => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20heL2KoTcl3lT5MB4kOzFyoD8j1yg5UNkaz_xIdfEd1A5aQ3U-lPskunphJHptZvPwSM26CUht3_UmUe3gEpSLrs4ZlidBgY'                       => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf2PLacDBA5ciJlY20hPbkI7PYhG5u5cRjiOXE_JbwjGu4ohQ0J3egI4ORcQNqYw3W8la5w-frgJK77ZXKwCQysyVwtnbayxKzhxlIarRum7XAHvqFh2jA'                  => 'Sapphire'
        ],
        '★ Butterfly Knife | Gamma Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPL5NqnQmm9u5cRjiOXE_JbwjGu4ohQ0J3f6JtPEegNrMwvUrwe6kLjsjcPtuJXJmnFguCMn5i7enkDkiRFIabM7m7XAHtBCTvK7'                  => 'Emerald',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPD1PrbQqW9e-NV9j_v-5YT0m1HllB81NDG3OobHdVJqYw2C-FTox-fshse-7pSamCZi6HZz5SzezEHm0k0ab-FtgPWACQLJ_leCpCU'               => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPD1PrbQqW9e-NV9j_v-5YT0m1HmlB81NDG3OtOcdlM5MF3Srla4wO-8h5PuucyawHo37HZxsXePnEe20xseaLBnhPSACQLJc-o5FQc'               => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPD1PrbQqW9e-NV9j_v-5YT0m1HnlB81NDG3OtDBJlBoaF7X_1i3wLjvg5G1uZrNmnNj7ihztHfazhyziB5LaLdu0KCACQLJ4CaO33U'               => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPD1PrbQqW9e-NV9j_v-5YT0m1HglB81NDG3OoPDdwc4YViC-QW5lb_v1pC56pTOynprvHZ35n_YzEC3iEtEOOJqgaSACQLJ2iXmey0'               => 'Phase 4'
        ],
        '★ Butterfly Knife | Doppler' => [
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPX4Mrjahm5Q-slOh-jT94DwgU6xryw-DDWqc97RbA9vN1GD8gO2ybq7hsK9tZ_By3ZqsiJw7X3elxzj1xpPb7c506GZSVmAR_selHmOwYo'           => 'Black Pearl',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPP7I6vdk3lu-M1wmeyQyoD8j1yg5RVtMmCmctOWJlI-YwyD_VG8w-nohsPt78zKz3Zhsygq4HnczEHk0k5SLrs4Un2yL0k'                       => 'Phase 1',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPP7I6vdk3lu-M1wmeyTyo7KhF2zowdyYmqicYedI1NoYAvR-FK5yevmg5S6us_MnSFjuSYm4ivaykDigBtIa_sv26I7TRzdOw'                    => 'Phase 2',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPP7I6vdk3lu-M1wmeySyoD8j1yg5Uo_MGD7cYaXdw5oN1HS_Fnrx-m91MTt6JjJnXtmsicr7SrZyxK2gUxSLrs40_zJGdY'                       => 'Phase 3',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqPP7I6vdk3lu-M1wmeyVyoD8j1yg5UM-YDz2I4OScwJsZl7Vr1O9x-u9g8K6uJnOzHM16ScktnmJmR23hhhSLrs4sbhU0c4'                       => 'Phase 4',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqOXhMaLum2pD6sl0g_PE8bP5gVO8v11kYjjzJ9KcIFI5YliDqAXoxbrsgpC9up_BmCM17nYh4SndzRLl1xwdcKUx0pRZROip'                      => 'Ruby',
            '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqOT1I6vZn3lU18hwmOvN8IXvjVCLqSwwOj6rYJiRdg42NAuE-lW5kri5hpbuvM7AzHtmsnMh4imPzUa3gB4aaOw9hfCeVxzAUJ5TOTzr'              => 'Sapphire'
        ]
    ];
}