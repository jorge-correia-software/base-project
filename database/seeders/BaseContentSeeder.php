<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::where('email', 'admin@base-scotland.com')->first();

        // Create Programs
        $programs = [
            ['title' => 'Startup Accelerator', 'slug' => 'startup-accelerator', 'description' => 'Intensive support for early-stage businesses with mentorship, funding access, and growth resources.', 'icon' => 'rocket_launch', 'order' => 1],
            ['title' => 'Growth Programme', 'slug' => 'growth-programme', 'description' => 'Strategic support for established businesses looking to scale operations and expand market reach.', 'icon' => 'trending_up', 'order' => 2],
            ['title' => 'Sustainability Initiative', 'slug' => 'sustainability-initiative', 'description' => 'Helping businesses transition to sustainable practices with expert guidance and green funding opportunities.', 'icon' => 'eco', 'order' => 3],
            ['title' => 'Innovation Lab', 'slug' => 'innovation-lab', 'description' => 'Access to cutting-edge technology and resources to develop innovative solutions.', 'icon' => 'lightbulb', 'order' => 4],
            ['title' => 'Export Development', 'slug' => 'export-development', 'description' => 'Support for businesses looking to expand into international markets.', 'icon' => 'public', 'order' => 5],
            ['title' => 'Digital Transformation', 'slug' => 'digital-transformation', 'description' => 'Guidance and resources to help businesses embrace digital technologies.', 'icon' => 'computer', 'order' => 6],
        ];

        foreach ($programs as $program) {
            \App\Models\Program::create($program);
        }

        // Create Support Areas
        $supportAreas = [
            [
                'title' => 'Financial Guidance',
                'slug' => 'financial-guidance',
                'description' => 'Edinburgh College\'s BASE (Business Advice & Support for Entrepreneurs) offers expert guidance on funding, investment and financial planning for Scottish businesses. Our advisers help refine your proposition and connect you with the right finance partners.',
                'content' => 'From seed funding to later-stage rounds, we tailor support to your goals: business plan development, financial modelling and forecasting, grant application support, investor materials, and cash-flow management. We\'ll also help you navigate the funding landscape—grants, loans and equity—so you choose the right route at the right time.',
                'icon' => 'account_balance',
                'featured_image' => '/images/support/financial-guidance.jpg',
                'order' => 1
            ],
            [
                'title' => 'Marketing Strategy',
                'slug' => 'marketing-strategy',
                'description' => 'Edinburgh College\'s BASE helps you develop effective marketing plans and a strong digital presence to reach the right audiences. We focus on building a clear brand identity and connecting with customers through modern, data-driven marketing.',
                'content' => 'From brand positioning and messaging to digital strategy and social media planning, we provide end-to-end support to elevate your market presence. Our team guides you through content marketing, market research and analysis, customer segmentation and competitive positioning—showing you how to combine traditional and digital channels to maximise reach and ROI.',
                'icon' => 'campaign',
                'featured_image' => '/images/support/marketing-strategy.jpg',
                'order' => 2
            ],
            [
                'title' => 'Innovation Vouchers',
                'slug' => 'innovation-vouchers',
                'description' => 'Edinburgh College\'s BASE helps businesses apply for Scottish Funding Council Innovation Vouchers—up to £7,500 to collaborate with academic staff on new products, processes or services. There\'s also the option to seek an Advanced Innovation Voucher for further support.',
                'content' => 'BASE guides you through the application, matches you with the right academic expertise, and assists with project planning to maximise impact. Eligible applicants must be Scotland-based, registered companies with a clear need for academic input not readily available commercially. For more information, please email lewis.steen@edinburghcollege.ac.uk.',
                'icon' => 'lightbulb',
                'featured_image' => '/images/support/innovation-vouchers.jpg',
                'order' => 3
            ],
            ['title' => 'Training & Development', 'slug' => 'training-development', 'description' => 'Professional development and skills training programs', 'icon' => 'school', 'order' => 4],
            ['title' => 'Mentorship', 'slug' => 'mentorship', 'description' => 'One-on-one guidance from experienced business leaders', 'icon' => 'groups', 'order' => 5],
            ['title' => 'Networking', 'slug' => 'networking', 'description' => 'Connect with partners, investors, and fellow entrepreneurs', 'icon' => 'network_check', 'order' => 6],
            ['title' => 'Legal Support', 'slug' => 'legal-support', 'description' => 'Access to legal advice and business compliance guidance', 'icon' => 'gavel', 'order' => 7],
            ['title' => 'Technology Solutions', 'slug' => 'technology-solutions', 'description' => 'IT infrastructure and software development support', 'icon' => 'developer_board', 'order' => 8],
        ];

        foreach ($supportAreas as $area) {
            \App\Models\SupportArea::create($area);
        }

        // Create Testimonials
        $testimonials = [
            [
                'author_name' => 'Sarah Mitchell',
                'author_title' => 'CEO',
                'author_company' => 'TechFlow Solutions',
                'content' => 'BASE provided the perfect springboard for our startup. The mentorship and funding support were invaluable in our first year.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'author_name' => 'James Robertson',
                'author_title' => 'Founder',
                'author_company' => 'Scottish Craft Co.',
                'content' => 'The Growth Programme helped us expand into new markets we never thought possible. Outstanding support every step of the way.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'author_name' => 'Emma Douglas',
                'author_title' => 'Managing Director',
                'author_company' => 'EcoManufacturing Ltd',
                'content' => 'Thanks to BASE\'s sustainability initiative, we\'ve cut costs and reduced our carbon footprint. A true win-win for our business.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            \App\Models\Testimonial::create($testimonial);
        }

        // Create Categories
        $categories = [
            ['name' => 'News', 'slug' => 'news', 'description' => 'Latest updates and announcements'],
            ['name' => 'Success Stories', 'slug' => 'success-stories', 'description' => 'Stories from businesses we\'ve supported'],
            ['name' => 'Resources', 'slug' => 'resources', 'description' => 'Helpful guides and resources'],
            ['name' => 'Events', 'slug' => 'events', 'description' => 'Upcoming events and workshops'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create($cat);
        }

        // Create Tags
        $tags = [
            ['name' => 'Funding', 'slug' => 'funding'],
            ['name' => 'Startups', 'slug' => 'startups'],
            ['name' => 'Growth', 'slug' => 'growth'],
            ['name' => 'Sustainability', 'slug' => 'sustainability'],
            ['name' => 'Innovation', 'slug' => 'innovation'],
            ['name' => 'Technology', 'slug' => 'technology'],
        ];

        foreach ($tags as $tag) {
            \App\Models\Tag::create($tag);
        }

        // Create sample posts
        $newsCategory = \App\Models\Category::where('slug', 'news')->first();

        $posts = [
            [
                'title' => 'New £2M Funding Programme Launched for Scottish Startups',
                'slug' => 'new-2m-funding-programme-launched',
                'excerpt' => 'BASE announces major new funding initiative targeting tech and sustainability sectors.',
                'content' => 'We are excited to announce the launch of a new £2M funding programme designed to support innovative Scottish startups in the technology and sustainability sectors...',
                'category_id' => $newsCategory->id,
                'author_id' => $admin->id,
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Success Story: How TechFlow Solutions Scaled to 50 Employees',
                'slug' => 'techflow-solutions-success-story',
                'excerpt' => 'Learn how one of our accelerator graduates grew from a 3-person team to 50+ employees in 18 months.',
                'content' => 'TechFlow Solutions joined our Startup Accelerator programme in early 2023 with just three co-founders and a vision. Today, they employ over 50 people...',
                'category_id' => \App\Models\Category::where('slug', 'success-stories')->first()->id,
                'author_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Essential Guide to Business Planning in 2025',
                'slug' => 'essential-guide-business-planning-2025',
                'excerpt' => 'Our comprehensive guide to creating effective business plans for the modern market.',
                'content' => 'Creating a solid business plan is more important than ever in 2025\'s dynamic market environment. This guide will walk you through...',
                'category_id' => \App\Models\Category::where('slug', 'resources')->first()->id,
                'author_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
        ];

        foreach ($posts as $postData) {
            \App\Models\Post::create($postData);
        }

        // Create Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'BASE - Business Advice and Support for Entrepreneurs', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Empowering Business Growth in Scotland', 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@base-scotland.com', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+44 (0) 131 XXX XXXX', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Bankhead Avenue, Sighthill, Edinburgh, EH11 4DE', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'seo_meta_title', 'value' => 'BASE Scotland - Business Support & Funding', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'seo_meta_description', 'value' => 'BASE provides comprehensive business support, funding opportunities, and expert guidance to help Scottish businesses thrive and succeed.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/basescotland', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/basescotland', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/basescotland', 'type' => 'url', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::create($setting);
        }
    }
}
