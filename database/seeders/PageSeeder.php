<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user as author
        $author = User::first();

        if (!$author) {
            $this->command->error('No users found. Please run UserSeeder first.');
            return;
        }

        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'excerpt' => 'Our commitment to protecting your personal data and privacy.',
                'content' => $this->getPrivacyPolicyContent(),
                'status' => 'published',
                'template' => 'default',
                'author_id' => $author->id,
                'published_at' => now(),
                'order' => 1,
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'excerpt' => 'Terms and conditions governing the use of our services and website.',
                'content' => $this->getTermsOfServiceContent(),
                'status' => 'published',
                'template' => 'default',
                'author_id' => $author->id,
                'published_at' => now(),
                'order' => 2,
            ],
            [
                'title' => 'Cookie Policy',
                'slug' => 'cookie-policy',
                'excerpt' => 'How we use cookies and similar technologies on our website.',
                'content' => $this->getCookiePolicyContent(),
                'status' => 'published',
                'template' => 'default',
                'author_id' => $author->id,
                'published_at' => now(),
                'order' => 3,
            ],
            [
                'title' => 'Frequently Asked Questions',
                'slug' => 'faq',
                'excerpt' => 'Find answers to common questions about BASE services, programs, and support.',
                'content' => $this->getFAQContent(),
                'status' => 'published',
                'template' => 'default',
                'author_id' => $author->id,
                'published_at' => now(),
                'order' => 4,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }

        $this->command->info('Successfully created ' . count($pages) . ' pages.');
    }

    private function getPrivacyPolicyContent(): string
    {
        return <<<'HTML'
<h2>Privacy Policy</h2>
<p><strong>Last Updated:</strong> January 2025</p>

<h3>1. Introduction</h3>
<p>Business Acceleration and Support Enterprise (BASE) is committed to protecting your privacy and personal data. This Privacy Policy explains how we collect, use, store, and protect your information when you use our website and services.</p>

<h3>2. Information We Collect</h3>
<h4>2.1 Information You Provide</h4>
<ul>
    <li>Name, email address, and contact details when you register or contact us</li>
    <li>Business information when you apply for programs or support</li>
    <li>Payment information when you use paid services</li>
    <li>Feedback, survey responses, and correspondence</li>
</ul>

<h4>2.2 Information We Collect Automatically</h4>
<ul>
    <li>IP address, browser type, and device information</li>
    <li>Pages visited, time spent on pages, and navigation paths</li>
    <li>Cookies and similar tracking technologies (see our Cookie Policy)</li>
</ul>

<h3>3. How We Use Your Information</h3>
<p>We use your personal data to:</p>
<ul>
    <li>Provide and improve our services and programs</li>
    <li>Process your applications and requests</li>
    <li>Communicate with you about our services, events, and opportunities</li>
    <li>Analyze and improve our website performance</li>
    <li>Comply with legal obligations and protect our rights</li>
</ul>

<h3>4. Legal Basis for Processing</h3>
<p>We process your personal data based on:</p>
<ul>
    <li><strong>Consent:</strong> When you provide explicit consent</li>
    <li><strong>Contract:</strong> When necessary to fulfill our services to you</li>
    <li><strong>Legal Obligation:</strong> When required by law</li>
    <li><strong>Legitimate Interests:</strong> For business operations and improvements</li>
</ul>

<h3>5. Data Sharing and Disclosure</h3>
<p>We may share your information with:</p>
<ul>
    <li>Service providers and partners who help us deliver our services</li>
    <li>Government agencies when required by law or for grant reporting</li>
    <li>Professional advisors (lawyers, accountants, auditors)</li>
</ul>
<p>We do not sell your personal data to third parties.</p>

<h3>6. Data Security</h3>
<p>We implement appropriate technical and organizational measures to protect your personal data, including:</p>
<ul>
    <li>Encryption of data in transit and at rest</li>
    <li>Regular security assessments and updates</li>
    <li>Access controls and staff training</li>
    <li>Secure data storage and backup procedures</li>
</ul>

<h3>7. Your Rights</h3>
<p>Under UK GDPR and Data Protection Act 2018, you have the right to:</p>
<ul>
    <li><strong>Access:</strong> Request copies of your personal data</li>
    <li><strong>Rectification:</strong> Correct inaccurate or incomplete data</li>
    <li><strong>Erasure:</strong> Request deletion of your data</li>
    <li><strong>Restriction:</strong> Limit how we use your data</li>
    <li><strong>Portability:</strong> Receive your data in a portable format</li>
    <li><strong>Object:</strong> Object to processing based on legitimate interests</li>
    <li><strong>Withdraw Consent:</strong> Withdraw consent at any time</li>
</ul>

<h3>8. Data Retention</h3>
<p>We retain your personal data only as long as necessary for the purposes outlined in this policy, or as required by law. Typically:</p>
<ul>
    <li>Application data: 7 years after program completion</li>
    <li>Website analytics: 26 months</li>
    <li>Marketing communications: Until you unsubscribe</li>
</ul>

<h3>9. International Transfers</h3>
<p>Your data is primarily stored and processed within the UK. If we transfer data outside the UK, we ensure appropriate safeguards are in place.</p>

<h3>10. Children's Privacy</h3>
<p>Our services are not intended for individuals under 18. We do not knowingly collect personal data from children.</p>

<h3>11. Changes to This Policy</h3>
<p>We may update this Privacy Policy from time to time. We will notify you of significant changes via email or website notice.</p>

<h3>12. Contact Us</h3>
<p>For questions about this Privacy Policy or to exercise your rights, please contact us:</p>
<p>
    <strong>BASE - Business Acceleration and Support Enterprise</strong><br>
    Email: privacy@base.scot<br>
    Address: Bankhead Avenue, Sighthill, Edinburgh, EH11 4DE
</p>

<h3>13. Complaints</h3>
<p>If you have concerns about how we handle your data, you can lodge a complaint with:</p>
<p>
    <strong>Information Commissioner's Office (ICO)</strong><br>
    Website: ico.org.uk<br>
    Phone: 0303 123 1113
</p>
HTML;
    }

    private function getTermsOfServiceContent(): string
    {
        return <<<'HTML'
<h2>Terms of Service</h2>
<p><strong>Last Updated:</strong> January 2025</p>

<h3>1. Acceptance of Terms</h3>
<p>By accessing and using the BASE (Business Acceleration and Support Enterprise) website and services, you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.</p>

<h3>2. About BASE</h3>
<p>BASE is a Scottish business support organization providing programs, funding opportunities, and resources to help businesses grow and succeed. We are committed to fostering innovation and entrepreneurship across Scotland.</p>

<h3>3. Use of Services</h3>
<h4>3.1 Eligibility</h4>
<p>You must be at least 18 years old and legally able to enter into contracts to use our services.</p>

<h4>3.2 Account Registration</h4>
<ul>
    <li>You are responsible for maintaining the confidentiality of your account credentials</li>
    <li>You must provide accurate and complete information</li>
    <li>You must notify us immediately of any unauthorized use</li>
    <li>You are responsible for all activities under your account</li>
</ul>

<h4>3.3 Acceptable Use</h4>
<p>You agree NOT to:</p>
<ul>
    <li>Use our services for any unlawful purpose</li>
    <li>Violate any laws or regulations</li>
    <li>Infringe on intellectual property rights</li>
    <li>Transmit malicious code or viruses</li>
    <li>Harass, abuse, or harm others</li>
    <li>Impersonate others or provide false information</li>
    <li>Scrape or mine data without permission</li>
</ul>

<h3>4. Programs and Services</h3>
<h4>4.1 Application Process</h4>
<ul>
    <li>Applications are subject to eligibility criteria and review</li>
    <li>We reserve the right to accept or reject any application</li>
    <li>Application decisions are final</li>
</ul>

<h4>4.2 Program Participation</h4>
<ul>
    <li>Participants must comply with program-specific terms and conditions</li>
    <li>We reserve the right to terminate participation for non-compliance</li>
    <li>Funding and support are subject to availability and eligibility</li>
</ul>

<h3>5. Intellectual Property</h3>
<h4>5.1 Our Content</h4>
<p>All content on this website, including text, graphics, logos, and software, is owned by BASE or our licensors and protected by copyright, trademark, and other intellectual property laws.</p>

<h4>5.2 User Content</h4>
<p>By submitting content to us (applications, feedback, etc.), you grant us a non-exclusive, worldwide, royalty-free license to use, reproduce, and display that content for our business purposes.</p>

<h3>6. Disclaimers and Limitations</h3>
<h4>6.1 No Warranties</h4>
<p>Our services are provided "as is" without warranties of any kind, express or implied. We do not guarantee:</p>
<ul>
    <li>Uninterrupted or error-free service</li>
    <li>Accuracy or completeness of information</li>
    <li>Specific results from using our services</li>
</ul>

<h4>6.2 Limitation of Liability</h4>
<p>To the fullest extent permitted by law, BASE shall not be liable for:</p>
<ul>
    <li>Indirect, incidental, or consequential damages</li>
    <li>Loss of profits, data, or business opportunities</li>
    <li>Damages exceeding the fees paid to us (if any)</li>
</ul>

<h3>7. Indemnification</h3>
<p>You agree to indemnify and hold BASE harmless from any claims, damages, or expenses arising from your use of our services or violation of these terms.</p>

<h3>8. Third-Party Links</h3>
<p>Our website may contain links to third-party websites. We are not responsible for the content, policies, or practices of these sites.</p>

<h3>9. Termination</h3>
<p>We reserve the right to suspend or terminate your access to our services at any time, with or without notice, for:</p>
<ul>
    <li>Violation of these terms</li>
    <li>Fraudulent or illegal activity</li>
    <li>At our discretion for business reasons</li>
</ul>

<h3>10. Governing Law</h3>
<p>These terms are governed by the laws of Scotland and the United Kingdom. Any disputes shall be resolved in the courts of Scotland.</p>

<h3>11. Changes to Terms</h3>
<p>We may update these Terms of Service at any time. Continued use of our services after changes constitutes acceptance of the new terms.</p>

<h3>12. Contact Information</h3>
<p>For questions about these Terms of Service, please contact us:</p>
<p>
    <strong>BASE - Business Acceleration and Support Enterprise</strong><br>
    Email: info@base.scot<br>
    Address: Bankhead Avenue, Sighthill, Edinburgh, EH11 4DE<br>
    Phone: 0131 XXX XXXX
</p>

<h3>13. Severability</h3>
<p>If any provision of these terms is found to be invalid or unenforceable, the remaining provisions shall continue in full force and effect.</p>

<h3>14. Entire Agreement</h3>
<p>These Terms of Service, together with our Privacy Policy and Cookie Policy, constitute the entire agreement between you and BASE regarding the use of our services.</p>
HTML;
    }

    private function getCookiePolicyContent(): string
    {
        return <<<'HTML'
<h2>Cookie Policy</h2>
<p><strong>Last Updated:</strong> January 2025</p>

<h3>1. What Are Cookies?</h3>
<p>Cookies are small text files that are placed on your device when you visit a website. They help websites remember information about your visit, making your next visit easier and the site more useful to you.</p>

<h3>2. How We Use Cookies</h3>
<p>BASE uses cookies to:</p>
<ul>
    <li>Remember your preferences and settings</li>
    <li>Understand how you use our website</li>
    <li>Improve your browsing experience</li>
    <li>Provide relevant content and features</li>
    <li>Analyze website traffic and performance</li>
</ul>

<h3>3. Types of Cookies We Use</h3>

<h4>3.1 Essential Cookies</h4>
<p>These cookies are necessary for the website to function properly. They enable core functionality such as security, authentication, and accessibility.</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Cookie Name</th>
            <th>Purpose</th>
            <th>Duration</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>XSRF-TOKEN</td>
            <td>Security protection against cross-site request forgery</td>
            <td>Session</td>
        </tr>
        <tr>
            <td>laravel_session</td>
            <td>Maintains your session state</td>
            <td>2 hours</td>
        </tr>
        <tr>
            <td>remember_token</td>
            <td>Keeps you logged in if you choose "Remember Me"</td>
            <td>30 days</td>
        </tr>
    </tbody>
</table>

<h4>3.2 Analytics Cookies</h4>
<p>These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously.</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Cookie Name</th>
            <th>Purpose</th>
            <th>Duration</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>_ga</td>
            <td>Google Analytics - distinguishes unique users</td>
            <td>2 years</td>
        </tr>
        <tr>
            <td>_gid</td>
            <td>Google Analytics - distinguishes users</td>
            <td>24 hours</td>
        </tr>
        <tr>
            <td>_gat</td>
            <td>Google Analytics - throttles request rate</td>
            <td>1 minute</td>
        </tr>
    </tbody>
</table>

<h4>3.3 Functional Cookies</h4>
<p>These cookies enable enhanced functionality and personalization, such as remembering your preferences.</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Cookie Name</th>
            <th>Purpose</th>
            <th>Duration</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>user_preferences</td>
            <td>Stores your site preferences (theme, language, etc.)</td>
            <td>1 year</td>
        </tr>
        <tr>
            <td>cookie_consent</td>
            <td>Records your cookie consent preferences</td>
            <td>1 year</td>
        </tr>
    </tbody>
</table>

<h4>3.4 Marketing Cookies</h4>
<p>These cookies track your online activity to help advertisers deliver more relevant advertising or limit how many times you see an ad.</p>
<p><em>Note: We currently do not use marketing cookies on our website.</em></p>

<h3>4. Third-Party Cookies</h3>
<p>Some cookies are placed by third-party services that appear on our pages. We use:</p>
<ul>
    <li><strong>Google Analytics:</strong> To analyze website traffic and usage</li>
    <li><strong>Social Media Widgets:</strong> To enable sharing content on social platforms</li>
</ul>
<p>These third parties have their own privacy policies and cookie policies.</p>

<h3>5. Managing Cookies</h3>

<h4>5.1 Browser Settings</h4>
<p>Most web browsers allow you to control cookies through their settings. You can:</p>
<ul>
    <li>See what cookies you have and delete them individually</li>
    <li>Block third-party cookies</li>
    <li>Block all cookies from specific sites</li>
    <li>Block all cookies entirely</li>
    <li>Delete all cookies when you close your browser</li>
</ul>

<h4>5.2 Browser-Specific Instructions</h4>
<ul>
    <li><strong>Chrome:</strong> Settings > Privacy and security > Cookies and other site data</li>
    <li><strong>Firefox:</strong> Options > Privacy & Security > Cookies and Site Data</li>
    <li><strong>Safari:</strong> Preferences > Privacy > Cookies and website data</li>
    <li><strong>Edge:</strong> Settings > Cookies and site permissions > Cookies and site data</li>
</ul>

<h4>5.3 Opt-Out Tools</h4>
<ul>
    <li><strong>Google Analytics:</strong> <a href="https://tools.google.com/dlpage/gaoptout" target="_blank">Google Analytics Opt-out Browser Add-on</a></li>
    <li><strong>Network Advertising Initiative:</strong> <a href="https://optout.networkadvertising.org/" target="_blank">NAI Opt-Out</a></li>
</ul>

<h3>6. Impact of Disabling Cookies</h3>
<p>Please note that if you disable cookies:</p>
<ul>
    <li>Some features of our website may not function properly</li>
    <li>You may not be able to stay logged in</li>
    <li>Your preferences will not be saved</li>
    <li>You may see less relevant content</li>
</ul>

<h3>7. Cookie Consent</h3>
<p>When you first visit our website, you will be asked to accept our use of cookies. You can change your consent at any time by:</p>
<ul>
    <li>Clicking the "Cookie Settings" link in the footer</li>
    <li>Clearing your cookies and revisiting our site</li>
    <li>Adjusting your browser settings</li>
</ul>

<h3>8. Updates to This Policy</h3>
<p>We may update this Cookie Policy from time to time to reflect changes in technology, legislation, or our business operations. Please check this page periodically for updates.</p>

<h3>9. More Information</h3>
<p>For more information about cookies and how they work, visit:</p>
<ul>
    <li><a href="https://www.allaboutcookies.org" target="_blank">All About Cookies</a></li>
    <li><a href="https://ico.org.uk/for-the-public/online/cookies/" target="_blank">ICO - Cookies</a></li>
</ul>

<h3>10. Contact Us</h3>
<p>If you have questions about our use of cookies, please contact us:</p>
<p>
    <strong>BASE - Business Acceleration and Support Enterprise</strong><br>
    Email: privacy@base.scot<br>
    Address: Bankhead Avenue, Sighthill, Edinburgh, EH11 4DE
</p>
HTML;
    }

    private function getFAQContent(): string
    {
        return <<<'HTML'
<h2>Frequently Asked Questions</h2>
<p>Find answers to common questions about BASE services, programs, and support.</p>

<h3>General Questions</h3>

<h4>What is BASE?</h4>
<p>BASE (Business Acceleration and Support Enterprise) is Scotland's premier business support organization dedicated to fostering innovation, growth, and sustainability across all business sectors. We provide comprehensive support, funding opportunities, and expert guidance to help Scottish businesses thrive.</p>

<h4>Who can access BASE services?</h4>
<p>BASE services are available to:</p>
<ul>
    <li>Scottish-based businesses of all sizes</li>
    <li>Startups and entrepreneurs with viable business ideas</li>
    <li>Social enterprises and community organizations</li>
    <li>Businesses looking to scale and expand</li>
</ul>

<h4>Is there a cost for BASE services?</h4>
<p>Many BASE services are provided free of charge or at subsidized rates. Some specialized programs may have associated costs, which will be clearly communicated during the application process.</p>

<h3>Programs and Activities</h3>

<h4>What programs does BASE offer?</h4>
<p>BASE offers various programs including:</p>
<ul>
    <li><strong>Startup Accelerator:</strong> Intensive support for early-stage businesses</li>
    <li><strong>Growth Program:</strong> Strategic support for established businesses looking to scale</li>
    <li><strong>Sustainability Initiative:</strong> Helping businesses transition to sustainable practices</li>
    <li><strong>Innovation Labs:</strong> Collaborative spaces for testing new ideas</li>
</ul>
<p>Visit our <a href="/activities">Activities page</a> for detailed information about each program.</p>

<h4>How long do programs typically last?</h4>
<p>Program durations vary:</p>
<ul>
    <li>Startup Accelerator: 12 weeks</li>
    <li>Growth Program: 6-12 months</li>
    <li>Sustainability Initiative: 3-6 months</li>
    <li>Workshops and short courses: 1 day to 4 weeks</li>
</ul>

<h4>Can I participate in multiple programs?</h4>
<p>Yes, businesses can participate in multiple programs, subject to eligibility criteria and availability. However, we recommend focusing on one program at a time for maximum benefit.</p>

<h3>Application Process</h3>

<h4>How do I apply for BASE programs?</h4>
<p>To apply:</p>
<ol>
    <li>Review program details on our <a href="/activities">Activities page</a></li>
    <li>Check eligibility criteria</li>
    <li>Complete the online application form</li>
    <li>Submit required documentation</li>
    <li>Await review and decision (typically 2-4 weeks)</li>
</ol>

<h4>What documents do I need to apply?</h4>
<p>Typical requirements include:</p>
<ul>
    <li>Business plan or concept overview</li>
    <li>Financial projections or current financials</li>
    <li>Company registration documents (if applicable)</li>
    <li>CV/resume of key team members</li>
    <li>Proof of Scottish business address</li>
</ul>
<p>Specific requirements vary by program and will be listed in the application form.</p>

<h4>How long does the application process take?</h4>
<p>Application timelines typically are:</p>
<ul>
    <li>Application submission: 30-60 minutes</li>
    <li>Initial review: 1-2 weeks</li>
    <li>Interview (if required): 1 week after review</li>
    <li>Final decision: 2-4 weeks from submission</li>
</ul>

<h4>What happens if my application is rejected?</h4>
<p>If your application is not successful, you will receive feedback explaining the decision. You can:</p>
<ul>
    <li>Request additional feedback</li>
    <li>Reapply after addressing concerns</li>
    <li>Explore alternative programs that may be better suited</li>
</ul>

<h3>Support and Funding</h3>

<h4>What types of support does BASE provide?</h4>
<p>BASE offers comprehensive support including:</p>
<ul>
    <li><strong>Funding & Grants:</strong> Access to various funding opportunities</li>
    <li><strong>Mentorship:</strong> One-on-one guidance from industry experts</li>
    <li><strong>Training:</strong> Skills development workshops and courses</li>
    <li><strong>Networking:</strong> Connect with partners, investors, and peers</li>
    <li><strong>Resources:</strong> Business tools, templates, and guides</li>
</ul>
<p>Learn more on our <a href="/support">Support page</a>.</p>

<h4>Does BASE provide direct funding?</h4>
<p>BASE provides:</p>
<ul>
    <li>Grant funding for eligible businesses (subject to availability)</li>
    <li>Access to funding networks and investors</li>
    <li>Support with funding applications</li>
    <li>Financial planning guidance</li>
</ul>
<p>Funding amounts and criteria vary by program and business needs.</p>

<h4>Can I get one-on-one mentoring?</h4>
<p>Yes! BASE offers mentorship programs connecting you with experienced business leaders. Mentoring is available through:</p>
<ul>
    <li>Structured mentorship programs</li>
    <li>Ad-hoc advisory sessions</li>
    <li>Sector-specific expert consultations</li>
</ul>

<h3>Eligibility</h3>

<h4>Do I need to be registered as a business?</h4>
<p>Not necessarily. Requirements vary by program:</p>
<ul>
    <li><strong>Startup programs:</strong> Pre-registration concepts accepted</li>
    <li><strong>Growth programs:</strong> Registered business typically required</li>
    <li><strong>Funding applications:</strong> Usually require business registration</li>
</ul>

<h4>Can I apply if I'm not based in Scotland?</h4>
<p>BASE primarily supports Scottish-based businesses. However, we may consider applications from businesses planning to establish a Scottish presence or with significant Scottish operations.</p>

<h4>Is there an age requirement?</h4>
<p>Applicants must be 18 years or older. There is no upper age limit.</p>

<h3>Partners and Collaboration</h3>

<h4>How can my organization become a BASE partner?</h4>
<p>We welcome partnerships with organizations that share our mission. Partnership opportunities include:</p>
<ul>
    <li>Co-delivering programs</li>
    <li>Providing mentorship or expertise</li>
    <li>Funding partnerships</li>
    <li>Venue and resource sharing</li>
</ul>
<p>Contact us at partnerships@base.scot to discuss opportunities.</p>

<h4>Can I sponsor BASE programs?</h4>
<p>Yes! We welcome sponsorship from organizations wanting to support Scottish businesses. Sponsorship benefits include brand visibility, networking opportunities, and demonstrating corporate social responsibility.</p>

<h3>Events and Networking</h3>

<h4>Does BASE host networking events?</h4>
<p>Yes, we regularly host:</p>
<ul>
    <li>Monthly networking meetups</li>
    <li>Annual business conferences</li>
    <li>Sector-specific events</li>
    <li>Investor pitch nights</li>
    <li>Skills workshops</li>
</ul>
<p>Check our <a href="/highlights">Highlights page</a> for upcoming events.</p>

<h4>How do I stay updated on BASE news and events?</h4>
<p>Stay informed by:</p>
<ul>
    <li>Subscribing to our newsletter</li>
    <li>Following us on social media (LinkedIn, Twitter, Facebook)</li>
    <li>Checking our <a href="/highlights">Highlights page</a> regularly</li>
    <li>Joining our mailing list</li>
</ul>

<h3>Contact and Support</h3>

<h4>How can I contact BASE?</h4>
<p>You can reach us:</p>
<ul>
    <li><strong>General Inquiries:</strong> info@base.scot</li>
    <li><strong>Program Applications:</strong> programs@base.scot</li>
    <li><strong>Partnerships:</strong> partnerships@base.scot</li>
    <li><strong>Phone:</strong> 0131 XXX XXXX</li>
    <li><strong>Address:</strong> Bankhead Avenue, Sighthill, Edinburgh, EH11 4DE</li>
</ul>
<p>Visit our <a href="/#contact">Contact page</a> for more options.</p>

<h4>What are BASE's office hours?</h4>
<p>Our office is open:</p>
<ul>
    <li>Monday - Friday: 9:00 AM - 5:00 PM</li>
    <li>Closed on weekends and public holidays</li>
</ul>
<p>Email inquiries are typically responded to within 1-2 business days.</p>

<h4>Can I visit your office?</h4>
<p>Yes! We welcome visits, but please schedule an appointment in advance to ensure someone is available to assist you.</p>

<h3>Still Have Questions?</h3>
<p>If you couldn't find the answer you were looking for, please don't hesitate to <a href="/#contact">contact us</a>. Our team is here to help!</p>
HTML;
    }
}
