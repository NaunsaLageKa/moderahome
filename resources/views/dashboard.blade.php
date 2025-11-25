<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ModeraHome - My Account</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
    <div class="relative flex min-h-screen w-full">
        <aside class="flex w-64 flex-col bg-white dark:bg-gray-900/50 dark:border-r dark:border-gray-800 p-4 border-r border-gray-200">
            <div class="flex items-center gap-3 mb-8">
                <div class="bg-primary/20 rounded-full size-10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-2xl">chair</span>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-gray-900 dark:text-white text-base font-bold leading-normal">ModeraHome</h1>
                </div>
            </div>
            <div class="flex flex-col items-center gap-2 mb-8 border-b border-gray-200 dark:border-gray-800 pb-8">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-20" data-alt="Avatar of the current user" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuA1MFqiGW6Iq2pZteFelfkxT2X_pq_mywSETE47l4eWsuQaH_JG0-Cqqykmfl98ctAfvyLKf5gGYdWI5RJ93GIH3EEBWHnFBPj4_vXRyrnmaPlsT6ql8Uttxo-SP5JiLCDJUKYq_XwRM_sozPEHC1_LYBifSzbjH-QUhwSn3n72z2xQU0RSGKMJdG86MBdWzKwJB2Vda_vPAdR8dMRrik0HNw0luOi3hz0Wxi6I4sGaq4lbTPGeFLcWlXVgn-E-5gpaVtfegKM5ESM');"></div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mt-2">{{ Auth::user()->name ?? 'Olivia Smith' }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email ?? 'olivia.smith@email.com' }}</p>
            </div>
            <nav class="flex flex-col gap-2 flex-grow">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 text-primary" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <p class="text-sm font-medium leading-normal">Profile Settings</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
                    <span class="material-symbols-outlined">history</span>
                    <p class="text-sm font-medium leading-normal">Recently Viewed</p>
                </a>
            </nav>
            <div class="flex flex-col gap-1 border-t border-gray-200 dark:border-gray-800 pt-4">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
                    <span class="material-symbols-outlined">help</span>
                    <p class="text-sm font-medium leading-normal">Support</p>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 w-full">
                        <span class="material-symbols-outlined">logout</span>
                        <p class="text-sm font-medium leading-normal">Logout</p>
                    </button>
                </form>
            </div>
        </aside>
        <main class="flex-1 flex flex-col">
            <header class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 px-10 py-3 bg-white dark:bg-gray-900/50">
                <div class="flex items-center gap-8">
                    <h2 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Dashboard</h2>
                </div>
                <div class="flex flex-1 justify-end items-center gap-4">
                    <button class="flex cursor-pointer items-center justify-center rounded-lg h-10 w-10 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                    </button>
                </div>
            </header>
            <div class="p-10 flex-1 overflow-y-auto">
                <div class="max-w-xl mx-auto mb-10 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Hello, {{ Auth::user()->name ?? 'Olivia!' }}</h2>
                    <p class="text-center text-gray-600 dark:text-gray-400 mt-2">What are you looking for today?</p>
                    <div class="relative mt-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="material-symbols-outlined text-gray-500">search</span>
                        </div>
                        <input class="w-full h-14 pl-12 pr-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Search for furniture, styles, and more..." type="text" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    @php
                        $categories = [
                            ['title' => 'Living Room', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBG7diHekXGAyziipeQfjUrVZTZceHnRvbuavAIfU97JDxeBwrOKfGedegGCQRN2fZh-djNWHUU3L65tgIsaVufJLDkjHB6sCdm9xmhPteDkJr2J0IERZ2X3prMX3R-vwiudwlcYZ15TyAa-o7-xQyExip5s-HJXjyhlGwtoyuUd0_peiRCtC2dj5knGOcjfmXry6xI9ug7rzMN6QWTs5s-Q692i2iO_WXyvhR493nbOa8wqGqEMimgoLbZsrJtYC0Z1oWRFmgEOUs'],
                            ['title' => 'Bedroom', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBCBpuIWEnYekqAfplFerYod7C_rE5iCMndC-8EqSpXVnxW0-mT7tFi9jAUxE-tKZiuz4GbYxt-npK2j3fRYtNTQ0JL5PJbqlMZqanBoY8T0ko8kl7_54om-KuH2Am0mNUQ16MVxVGMXxVjg8guF3_Uc8ABKg0y8ZbxxanEJVonIKNQ6HiPPSh6QJ9BuxzMp5kD2BFT2DyMHTwle2arKtmOJgbDzN_0_ETc7tDgmk3L_Sz8-nxkAr40Pwk-1uLATyhwE19_CyhdXCw'],
                            ['title' => 'Dining', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDBJEbobAiCcKUnDIKy3O8asCiQdxlHQhzzmvffJf95IWCCmzPXReuxoFAAmHVjtsmhzV33tcw5zT4cQiHMx6paqoH76P3giOf9Cx9Apntd5Kn7yalq3eOvikHM05VptJxuGQXttUqw8NGeWsNu5tScUUO8LcIvBZGXAytwttGi216dL3FdNvVF7MHPiQLBsmegsrNBGuahbmLOAlsldye3HiULq7fV8hTz-xFk_B_t0bHawPO8-msouXU2ffi9-GyWokyLqcePk9U'],
                            ['title' => 'Office', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAYX0h-NjBqPVPqcNwRDpnicIUYic11Jc0MB7t2LjaQZ2xT26vBNzw5TsS3jzRJWIPlYVHoukp4aPVpn3iNIjpwXy7r6SONn5yec83FDawVDcsO_8Dj6e3uFpBIDRanjizsDzq4ObrrMXptQDOQUUVpCO8aZNmRG5zLw6nee-Y1IbSalQLeLnyloC_w24MPibjeNusCyg395Rwmo03CIUuKmCg8BZ1mH5pjDcaP28RQ01FXjUu8cGPzP8TXGg_-eDZ6uoRXvQxs3pc'],
                        ];
                    @endphp
                    @foreach ($categories as $category)
                        <a class="group relative flex flex-col justify-end overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 h-80" href="#">
                            <img alt="{{ $category['title'] }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" src="{{ $category['image'] }}" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                            <div class="relative z-10 p-6">
                                <h3 class="text-2xl font-bold text-white">{{ $category['title'] }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">You Might Also Like</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @php
                            $products = [
                                ['title' => 'Modern Oak Chair', 'desc' => 'Sleek & comfortable', 'price' => '$180', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDBwjV_IfTbh1G8R8o99YQ4khIU95-4AnKlPxs8RnpNuO4C29evXRDGHgr0SL5ZV_PbvU7A--w1TLHzdpHeTNvpeBQanNE9hDG0aoFwDRxjS67oEOuAy0abbShrlOOLqKY61eq4pdjTS1wuNcJgM3L-vaOObbr-o8HFNlOBehLHNYJwWh56oqVgtv_JTzmlI0yuY9180m-Z9i4fA37kwrsD-1ifBkUbZ-O2KhdhebmaSZtiuTy_o8SSH8ZgMgoCMx4ZC_ZZ3DuJ2AQ'],
                                ['title' => 'Velvet Accent Sofa', 'desc' => 'Plush and luxurious', 'price' => '$750', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDS1nTJ0OaVu-gOUGf1ucrN50kOHlrskgnqoMFKUfJqtdFFp94h1T19zHTYQMTkxgdFY1S889ieQy7JbZvc98tP0d_H_abgYCQjt-4PeEBDCZbqOLO7mWv4iNEO9o5aWdRmYM09PzOCa7UB143ibbrMyTx2qdk-Btq25tzAdAfrcjVRF1ST3Crmh3ggFIUNGCm-uEqoY7dZiYEVUKBom1bmyHWzVO1Wk0U6FOmHrqHcFk35A29CtQ8RwkKnfx8av5v_jdNXGzwdJEo'],
                                ['title' => 'Minimalist Coffee Table', 'desc' => 'Clean and modern design', 'price' => '$250', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBxlfnGx4RJA19Hgh4-_sZdjGBuikPCq8RyoMj8hAIYimyJu5YMZQcjfqpM-9gzlrNnbkR6K1tKhUqG0LNOiglS_rBNNpzzTv68Du5d2xfRHyBRAtPW_h5yDuPyhLqZEI71Za2Rlejt3q0y_Mbxe8GWIR9MdN5S3XxMRuWQ-Y6Dp2w6QT39UdoTfRTOJIBZ7ujesRfouFbBddrAd73qxVhnRhqwuQJU0RnnF6hNdG0ScCfY33G6PWsTnhpg97OQlqhFXplPirAZ4N0'],
                                ['title' => 'Industrial Bookshelf', 'desc' => 'Wood and metal fusion', 'price' => '$420', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDO8MWLzNmQKtwL284CkrVb32lkweh9mhlisExgbPCfRsbeXchzPkT9b_plj1KREZo68tJiAWOaq-9QhZ4QpaRmnvjGeomBsC2setJMVn3Y2MRaPDit4A1SDyjz703_jUwF7iaYeovyCVrzYj52DWg8FB-BMNltT7MbVQhvRaYZAm7r0ACxL1I0QIqD-HuQV6N4QDuzJCvJRMci7FrQ-6det4i-p9O4EJggWU_QDgIAyTWgxHsXgY-QhbW9J3-5drSTRQ732FQ6tf0'],
                            ];
                        @endphp
                        @foreach ($products as $product)
                            <div class="group flex flex-col bg-white dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                                <div class="relative">
                                    <img alt="{{ $product['title'] }}" class="h-56 w-full object-cover" src="{{ $product['image'] }}" />
                                    <button class="absolute top-3 right-3 flex items-center justify-center size-8 rounded-full bg-white/80 dark:bg-black/50 text-gray-700 dark:text-gray-300 hover:text-red-500 transition-colors">
                                        <span class="material-symbols-outlined text-xl">favorite</span>
                                    </button>
                                </div>
                                <div class="p-4 flex-1 flex flex-col">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">{{ $product['title'] }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $product['desc'] }}</p>
                                    <div class="flex items-center justify-between mt-4">
                                        <p class="text-lg font-bold text-primary">{{ $product['price'] }}</p>
                                        <button class="flex items-center justify-center size-9 bg-primary/20 rounded-full text-primary hover:bg-primary hover:text-white transition-colors">
                                            <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

