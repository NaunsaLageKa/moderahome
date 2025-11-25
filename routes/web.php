<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/categories/{category}', function (string $category) {
        $catalog = [
            'living-room' => [
                'title' => 'Living Room',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBG7diHekXGAyziipeQfjUrVZTZceHnRvbuavAIfU97JDxeBwrOKfGedegGCQRN2fZh-djNWHUU3L65tgIsaVufJLDkjHB6sCdm9xmhPteDkJr2J0IERZ2X3prMX3R-vwiudwlcYZ15TyAa-o7-xQyExip5s-HJXjyhlGwtoyuUd0_peiRCtC2dj5knGOcjfmXry6xI9ug7rzMN6QWTs5s-Q692i2iO_WXyvhR493nbOa8wqGqEMimgoLbZsrJtYC0Z1oWRFmgEOUs',
                'products' => [
                    ['title' => 'Modern Oak Chair', 'desc' => 'Sleek & comfortable', 'price' => '$180', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDBwjV_IfTbh1G8R8o99YQ4khIU95-4AnKlPxs8RnpNuO4C29evXRDGHgr0SL5ZV_PbvU7A--w1TLHzdpHeTNvpeBQanNE9hDG0aoFwDRxjS67oEOuAy0abbShrlOOLqKY61eq4pdjTS1wuNcJgM3L-vaOObbr-o8HFNlOBehLHNYJwWh56oqVgtv_JTzmlI0yuY9180m-Z9i4fA37kwrsD-1ifBkUbZ-O2KhdhebmaSZtiuTy_o8SSH8ZgMgoCMx4ZC_ZZ3DuJ2AQ'],
                    ['title' => 'Velvet Accent Sofa', 'desc' => 'Plush and luxurious', 'price' => '$750', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDS1nTJ0OaVu-gOUGf1ucrN50kOHlrskgnqoMFKUfJqtdFFp94h1T19zHTYQMTkxgdFY1S889ieQy7JbZvc98tP0d_H_abgYCQjt-4PeEBDCZbqOLO7mWv4iNEO9o5aWdRmYM09PzOCa7UB143ibbrMyTx2qdk-Btq25tzAdAfrcjVRF1ST3Crmh3ggFIUNGCm-uEqoY7dZiYEVUKBom1bmyHWzVO1Wk0U6FOmHrqHcFk35A29CtQ8RwkKnfx8av5v_jdNXGzwdJEo'],
                    ['title' => 'Minimalist Coffee Table', 'desc' => 'Clean and modern design', 'price' => '$250', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBxlfnGx4RJA19Hgh4-_sZdjGBuikPCq8RyoMj8hAIYimyJu5YMZQcjfqpM-9gzlrNnbkR6K1tKhUqG0LNOiglS_rBNNpzzTv68Du5d2xfRHyBRAtPW_h5yDuPyhLqZEI71Za2Rlejt3q0y_Mbxe8GWIR9MdN5S3XxMRuWQ-Y6Dp2w6QT39UdoTfRTOJIBZ7ujesRfouFbBddrAd73qxVhnRhqwuQJU0RnnF6hNdG0ScCfY33G6PWsTnhpg97OQlqhFXplPirAZ4N0'],
                    ['title' => 'Industrial Bookshelf', 'desc' => 'Wood and metal fusion', 'price' => '$420', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDO8MWLzNmQKtwL284CkrVb32lkweh9mhlisExgbPCfRsbeXchzPkT9b_plj1KREZo68tJiAWOaq-9QhZ4QpaRmnvjGeomBsC2setJMVn3Y2MRaPDit4A1SDyjz703_jUwF7iaYeovyCVrzYj52DWg8FB-BMNltT7MbVQhvRaYZAm7r0ACxL1I0QIqD-HuQV6N4QDuzJCvJRMci7FrQ-6det4i-p9O4EJggWU_QDgIAyTWgxHsXgY-QhbW9J3-5drSTRQ732FQ6tf0'],
                    ['title' => 'Coastal Linen Sectional', 'desc' => 'Modular comfort for families', 'price' => '$1,450', 'image' => 'https://images.unsplash.com/photo-1484100356142-db6ab6244067?auto=format&w=900&q=80'],
                    ['title' => 'Arc Floor Lamp', 'desc' => 'Soft glow for cozy evenings', 'price' => '$210', 'image' => 'https://images.unsplash.com/photo-1616628182504-7bef5c863e4c?auto=format&w=900&q=80'],
                    ['title' => 'Haven Media Console', 'desc' => 'Hidden storage with walnut finish', 'price' => '$690', 'image' => 'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&w=900&q=80'],
                    ['title' => 'Textured Area Rug', 'desc' => 'Adds warmth and balance', 'price' => '$320', 'image' => 'https://images.unsplash.com/photo-1505691938895-d9ae72c07c11?auto=format&w=900&q=80'],
                ],
            ],
            'bedroom' => [
                'title' => 'Bedroom',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBCBpuIWEnYekqAfplFerYod7C_rE5iCMndC-8EqSpXVnxW0-mT7tFi9jAUxE-tKZiuz4GbYxt-npK2j3fRYtNTQ0JL5PJbqlMZqanBoY8T0ko8kl7_54om-KuH2Am0mNUQ16MVxVGMXxVjg8guF3_Uc8ABKg0y8ZbxxanEJVonIKNQ6HiPPSh6QJ9BuxzMp5kD2BFT2DyMHTwle2arKtmOJgbDzN_0_ETc7tDgmk3L_Sz8-nxkAr40Pwk-1uLATyhwE19_CyhdXCw',
                'products' => [
                    ['title' => 'CloudSoft Bed Frame', 'desc' => 'Ultimate comfort and support', 'price' => '$899', 'image' => 'https://images.unsplash.com/photo-1616594039964-c2ba8cdffe98?auto=format&w=900&q=80'],
                    ['title' => 'Nordic Nightstand', 'desc' => 'Minimalist bedside storage', 'price' => '$220', 'image' => 'https://images.unsplash.com/photo-1505693314120-0d443867891c?auto=format&w=900&q=80'],
                    ['title' => 'Textured Throw Pillows', 'desc' => 'Set of 4 cozy pillows', 'price' => '$120', 'image' => 'https://images.unsplash.com/photo-1540573133985-87b6da6d54a9?auto=format&w=900&q=80'],
                    ['title' => 'Calm Glow Lamp', 'desc' => 'Warm dimmable lighting', 'price' => '$95', 'image' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&w=900&q=80'],
                ],
            ],
            'dining' => [
                'title' => 'Dining',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDBJEbobAiCcKUnDIKy3O8asCiQdxlHQhzzmvffJf95IWCCmzPXReuxoFAAmHVjtsmhzV33tcw5zT4cQiHMx6paqoH76P3giOf9Cx9Apntd5Kn7yalq3eOvikHM05VptJxuGQXttUqw8NGeWsNu5tScUUO8LcIvBZGXAytwttGi216dL3FdNvVF7MHPiQLBsmegsrNBGuahbmLOAlsldye3HiULq7fV8hTz-xFk_B_t0bHawPO8-msouXU2ffi9-GyWokyLqcePk9U',
                'products' => [
                    ['title' => 'Oak Dining Table', 'desc' => 'Seats up to 6 guests', 'price' => '$1,050', 'image' => 'https://images.unsplash.com/photo-1425315283416-2acc50323ee6?auto=format&w=900&q=80'],
                    ['title' => 'Linen Dining Chairs', 'desc' => 'Set of 4 soft chairs', 'price' => '$640', 'image' => 'https://images.unsplash.com/photo-1549187774-b4e9b0445b41?auto=format&w=900&q=80'],
                    ['title' => 'Sculpted Centerpiece', 'desc' => 'Handmade ceramic bowl', 'price' => '$140', 'image' => 'https://images.unsplash.com/photo-1484100356142-db6ab6244067?auto=format&w=900&q=80'],
                    ['title' => 'Essential Dinnerware', 'desc' => '24-piece stoneware set', 'price' => '$230', 'image' => 'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?auto=format&w=900&q=80'],
                ],
            ],
            'office' => [
                'title' => 'Office',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAYX0h-NjBqPVPqcNwRDpnicIUYic11Jc0MB7t2LjaQZ2xT26vBNzw5TsS3jzRJWIPlYVHoukp4aPVpn3iNIjpwXy7r6SONn5yec83FDawVDcsO_8Dj6e3uFpBIDRanjizsDzq4ObrrMXptQDOQUUVpCO8aZNmRG5zLw6nee-Y1IbSalQLeLnyloC_w24MPibjeNusCyg395Rwmo03CIUuKmCg8BZ1mH5pjDcaP28RQ01FXjUu8cGPzP8TXGg_-eDZ6uoRXvQxs3pc',
                'products' => [
                    ['title' => 'Sit-Stand Desk', 'desc' => 'Electronic height adjustment', 'price' => '$650', 'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&w=900&q=80'],
                    ['title' => 'ErgoFlex Chair', 'desc' => 'All-day back support', 'price' => '$420', 'image' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&w=900&q=80'],
                    ['title' => 'Storage Console', 'desc' => 'Hidden filing drawers', 'price' => '$380', 'image' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&w=900&q=80'],
                    ['title' => 'Focus Task Lamp', 'desc' => 'Adjustable LED lighting', 'price' => '$110', 'image' => 'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&w=900&q=80'],
                ],
            ],
        ];

        abort_unless(isset($catalog[$category]), 404);

        return view('category', [
            'categoryKey' => $category,
            'categoryData' => $catalog[$category],
            'products' => collect($catalog[$category]['products'])
                ->pad(16, null)
                ->chunk(4),
        ]);
    })->name('category.show');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
