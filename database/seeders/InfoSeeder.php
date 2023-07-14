<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Info;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo dữ liệu mẫu cho bảng infos
        $info = new Info();
        $info->title = 'Thông tin website';
        $info->logo1 = 'logo1.png';
        $info->logo2 = 'logo2.png';
        $info->image_login = 'image_login.jpg';
        $info->image_sighup = 'image_sighup.jpg';
        // Thêm các trường thông tin khác tương tự
        $info->logo_hotdeals = 'logo_hotdeals.png';
        $info->title_hotdeals = 'Hot Deals';
        $info->logo_categories = 'logo_categories.png';
        $info->title_categories = 'Categories';
        $info->title2_categories = 'Our Product Categories';
        $info->logo_dontmiss = 'logo_dontmiss.png';
        $info->title_dontmiss = "Don't Miss!";
        $info->title2_dontmiss = 'Product for You';
        $info->logo_thisweek = 'logo_thisweek.png';
        $info->title_thisweek = 'This Week';
        $info->title2_thisweek = 'Featured Products';
        $info->logo_mostsold = 'logo_mostsold.png';
        $info->title_mostsold = 'Most Sold';
        $info->title2_mostsold = 'Best Selling Products';
        $info->logo_whyus = 'logo_whyus.png';
        $info->title_whyus = 'Why Choose Us';
        $info->title2_whyus = 'Our Advantages';
        $info->address_store = '123 Main Street, City, Country';
        $info->phone_store = '123-456-7890';
        $info->email_store = 'info@example.com';
        $info->careers = 'We are hiring! Join our team.';
        $info->opening_hours = 'Mon-Fri: 9am-6pm, Sat-Sun: 10am-4pm';
        $info->address_support = '456 Second Street, City, Country';
        $info->phone_support = '987-654-3210';
        $info->youtube = 'https://www.youtube.com/channel/yourchannel';
        $info->title_download = 'Download Our App';
        $info->copyright = 'Copyright © 2023';

        // Lưu thông tin vào cơ sở dữ liệu
        $info->save();
    }
}
