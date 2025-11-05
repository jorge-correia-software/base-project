<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    private $activityImages = [
        'https://images.unsplash.com/photo-1559136555-9303baea8ebd?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1496449903678-68ddcb189a24?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1515169067868-5387ec356754?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1920&auto=format&fit=crop',
    ];

    private function getImage($index)
    {
        return $this->activityImages[$index % count($this->activityImages)];
    }

    private function getIcon($name, $company)
    {
        if ($company === 'Elevator') return 'Briefcase';
        if ($company === 'BRT') return 'Rocket';

        if (str_contains($name, 'Cashflow') || str_contains($name, 'Financial')) return 'Rocket';
        if (str_contains($name, 'Freelance')) return 'Users';
        if (str_contains($name, 'Money') || str_contains($name, 'Tax')) return 'DollarSign';
        if (str_contains($name, 'Marketing') || str_contains($name, 'Social Media')) return 'Target';
        if (str_contains($name, 'Business Planning') || str_contains($name, 'Planning')) return 'Briefcase';
        if (str_contains($name, 'Creative') || str_contains($name, 'Website')) return 'PenTool';
        if (str_contains($name, 'Neurodiverse')) return 'Brain';
        if (str_contains($name, 'Networking')) return 'Coffee';
        if (str_contains($name, 'Time Management')) return 'Clock';
        if (str_contains($name, 'Innovation')) return 'Lightbulb';
        if (str_contains($name, 'Internationalisation')) return 'Globe';
        if (str_contains($name, 'Green')) return 'Leaf';

        return 'Calendar';
    }

    private function getDescription($name)
    {
        if (str_contains($name, 'Cashflow')) return 'Learn essential techniques for managing business finances and cash flow.';
        if (str_contains($name, 'Freelance Academy')) return 'Transform your skills into a successful freelance business with expert guidance.';
        if (str_contains($name, 'Money')) return 'Discover and secure the right funding options for your business venture.';
        if (str_contains($name, 'Marketing')) return 'Master effective marketing strategies to grow your business and attract clients.';
        if (str_contains($name, 'Business Planning')) return 'Create a comprehensive business plan that will set you up for success.';
        if (str_contains($name, 'Website')) return 'Learn how to plan and develop an effective website for your business.';
        if (str_contains($name, 'Networking')) return 'Build valuable business relationships through effective networking strategies.';
        if (str_contains($name, 'Market Research')) return 'Learn how to conduct effective market research to inform your business decisions.';
        if (str_contains($name, 'Tax')) return 'Understand tax allowances and strategies to optimise your business finances.';
        if (str_contains($name, 'Start Up')) return 'Essential information for anyone looking to start a new business.';
        if (str_contains($name, 'Creative')) return 'Specialised business planning and strategies for creative entrepreneurs.';
        if (str_contains($name, 'Green')) return 'Discover sustainable business practices and eco-friendly strategies.';
        if (str_contains($name, 'Goal Setting')) return 'Learn effective goal setting techniques to drive your business forward.';
        if (str_contains($name, 'Time Management')) return 'Master time management skills to increase productivity and efficiency.';
        if (str_contains($name, 'Kitchen Table')) return 'Learn how to build a successful home-based business.';
        if (str_contains($name, 'Internationalisation')) return 'Expand your business globally with effective international strategies.';
        if (str_contains($name, 'Neurodiverse')) return 'Business strategies tailored for neurodiverse entrepreneurs.';
        if (str_contains($name, 'Sales for Introverts')) return 'Learn effective sales techniques designed for introverted personalities.';
        if (str_contains($name, 'Beginners Guide')) return 'A comprehensive introduction to social media for business growth.';
        if (str_contains($name, 'WIB')) return 'Connect with other women in business in a supportive networking environment.';
        if (str_contains($name, 'Xmas Networking')) return 'Celebrate the season while building valuable business connections.';
        if (str_contains($name, 'Financial Planning')) return 'Learn essential techniques for managing business finances and cash flow.';
        if (str_contains($name, 'Virtual Assistant')) return 'Learn how to start and grow a successful virtual assistant business.';
        if (str_contains($name, 'Innovation')) return 'Essential legal information for virtual assistants and online businesses.';
        if (str_contains($name, 'Basics of Making Money Online')) return 'Learn how to build a location-independent business and work from anywhere.';
        if (str_contains($name, 'Mindset')) return 'Develop essential executive function skills to enhance your business performance.';
        if (str_contains($name, 'Social Media Co-Working')) return 'Master effective marketing strategies to grow your business and attract clients.';
        if (str_contains($name, 'Planning for 2026')) return 'Prepare your business for success in the coming year with strategic planning.';

        return 'Join this workshop to gain valuable insights and skills for your business journey.';
    }

    public function run(): void
    {
        $activities = [
            ['Cashflow Made Easy', '2025-04-25', 'Elevator', '10am-12pm', 'S809/10', 0],
            ['Market Research Made Easy', '2025-04-25', 'Elevator', '12:30pm-2:30pm', 'S809/10', 1],
            ['Show Me The Money', '2025-04-25', 'Elevator', '3pm-5pm', 'S809/10', 2],
            ['Freelance Academy', '2025-04-30', 'BRT', '9am - 1pm', 'Online', 3],
            ['Kickstart Your Virtual Assistant Business', '2025-05-16', 'Elevator', '10am-12pm', 'S809/10', 4],
            ['Marketing Get Clients Now!', '2025-05-16', 'Elevator', '12:30-2:30pm', 'S809/10', 5],
            ['Innovation (Legal Checklist)', '2025-05-16', 'Elevator', '3-5pm', 'S809/10', 6],
            ['Cashflow Made Easy', '2025-05-23', 'Elevator', '10am-12pm', 'S809/10', 7],
            ['Financial Planning Made Easy', '2025-05-23', 'Elevator', '12:30pm-2:30pm', 'S809/10', 8],
            ['Market Research Made Easy', '2025-05-23', 'Elevator', '3-5pm', 'S809/10', 9],
            ['Cashflow Made Easy', '2025-06-20', 'Elevator', '10am-12pm', 'S809/10', 0],
            ['Financial Planning Made Easy', '2025-06-20', 'Elevator', '12:30-2:30pm', 'S809/10', 1],
            ['Goal Setting', '2025-06-20', 'Elevator', '3-5pm', 'S809/10', 2],
            ['Start Up Awareness', '2025-06-27', 'Elevator', '10am-12pm', 'S809/10', 3],
            ['Website Planning', '2025-06-27', 'Elevator', '12:30pm-2:30pm', 'S809/10', 4],
            ['Cashflow Made Easy', '2025-06-27', 'Elevator', '3-5pm', 'S809/10', 5],
            ['The Basics of Making Money Online', '2025-07-18', 'Elevator', '10am-12pm', 'S809/10', 6],
            ['Sales for Introverts', '2025-07-18', 'Elevator', '12:30pm-2:30pm', 'S809/10', 7],
            ['Show Me The Money', '2025-07-18', 'Elevator', '3pm-5pm', 'S809/10', 8],
            ['Tax Allowances', '2025-07-25', 'Elevator', '10am-12pm', 'S809/10', 9],
            ['WIB: Lunchtime networking', '2025-07-25', 'Elevator', '12:30pm-2:30pm', 'S809/10', 0],
            ['Marketing Get Clients Now!', '2025-07-25', 'Elevator', '3pm-5pm', 'S809/10', 1],
            ['Time Management', '2025-08-22', 'Elevator', '10am-12pm', 'S809/10', 2],
            ['Social Media Co-Working IN-PERSON', '2025-08-22', 'Elevator', '12:30pm-2:30pm', 'S809/10', 3],
            ['Goal Setting', '2025-08-29', 'Elevator', '10am-12pm', 'S809/10', 4],
            ['Internationalisation', '2025-08-29', 'Elevator', '12:30-2:30pm', 'S809/10', 5],
            ['Neurodiverse Minds (Cashflow)', '2025-08-29', 'Elevator', '3-5pm', 'S809/10', 6],
            ['Mindset - Do I Speak Giraffe?', '2025-09-19', 'Elevator', '10am-12pm', 'S809/10', 7],
            ['Marketing Get Clients Now!', '2025-09-19', 'Elevator', '12:30-2:30pm', 'S809/10', 8],
            ['Time Management', '2025-09-19', 'Elevator', '3-5pm', 'S809/10', 9],
            ['Cashflow Made Easy', '2025-09-26', 'Elevator', '10am-12pm', 'S809/10', 0],
            ['Market Research Made Easy', '2025-09-26', 'Elevator', '12:30pm-2:30pm', 'S809/10', 1],
            ['Show Me The Money', '2025-09-26', 'Elevator', '3pm-5pm', 'S809/10', 2],
            ['Goal Setting', '2025-10-24', 'Elevator', '10am-12pm', 'S809/10', 3],
            ['Start Up Awareness', '2025-10-24', 'Elevator', '12:30-2:30pm', 'S809/10', 4],
            ['Tax Allowances', '2025-10-24', 'Elevator', '3pm-5pm', 'S809/10', 5],
            ['Making Money in The Creative Industries', '2025-10-31', 'Elevator', '10am-12pm', 'S809/10', 6],
            ['Beginners Guide to Social Media', '2025-10-31', 'Elevator', '12:30-2:30pm', 'S809/10', 7],
            ['Kitchen Table Tycoons', '2025-10-31', 'Elevator', '3pm-5pm', 'S809/10', 8],
            ['Cashflow Made Easy', '2025-11-21', 'Elevator', '10am-12pm', 'S809/10', 9],
            ['Marketing Get Clients Now!', '2025-11-21', 'Elevator', '3pm-5pm', 'S809/10', 0],
            ['Show Me The Money', '2025-11-21', 'Elevator', '10am-12pm', 'S809/10', 1],
            ['Market Research Made Easy', '2025-11-28', 'Elevator', '10am-12pm', 'S809/10', 2],
            ['Creative Business Planning', '2025-11-28', 'Elevator', '12:30-2:30pm', 'S809/10', 3],
            ['Green for Go', '2025-11-28', 'Elevator', '3-5pm', 'S809/10', 4],
            ['Website Planning', '2025-12-12', 'Elevator', '10am-12pm', 'S809/10', 5],
            ['Time Management', '2025-12-12', 'Elevator', '12:30-2:30pm', 'S809/10', 6],
            ['Goal Setting', '2025-12-12', 'Elevator', '3-5pm', 'S809/10', 7],
            ['Planning for 2026', '2025-12-19', 'Elevator', '10am-12pm', 'S809/10', 8],
            ['Xmas Networking for Edinburgh', '2025-12-19', 'Elevator', '12:30-2:30pm', 'S809/10', 9],
        ];

        foreach ($activities as $activity) {
            Activity::create([
                'name' => $activity[0],
                'description' => $this->getDescription($activity[0]),
                'icon' => $this->getIcon($activity[0], $activity[2]),
                'image_url' => $this->getImage($activity[5]),
                'date' => $activity[1],
                'company' => $activity[2],
                'duration' => $activity[3],
                'location' => $activity[4],
                'price' => 'Free',
            ]);
        }
    }
}
