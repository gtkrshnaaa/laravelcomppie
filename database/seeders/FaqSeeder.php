<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $general = FaqCategory::create([
            'name' => 'General',
            'slug' => 'general',
            'order' => 1,
        ]);

        $services = FaqCategory::create([
            'name' => 'Services',
            'slug' => 'services',
            'order' => 2,
        ]);

        $pricing = FaqCategory::create([
            'name' => 'Pricing',
            'slug' => 'pricing',
            'order' => 3,
        ]);

        // Create FAQs
        Faq::create([
            'faq_category_id' => $general->id,
            'question' => 'What services do you offer?',
            'answer' => 'We offer a wide range of services including web development, mobile app development, UI/UX design, and digital consulting. Our team specializes in building custom solutions tailored to your specific business needs.',
            'order' => 1,
        ]);

        Faq::create([
            'faq_category_id' => $general->id,
            'question' => 'How long have you been in business?',
            'answer' => 'We have been providing professional technology solutions for over 10 years, serving clients across various industries worldwide.',
            'order' => 2,
        ]);

        Faq::create([
            'faq_category_id' => $services->id,
            'question' => 'Do you provide ongoing support and maintenance?',
            'answer' => 'Yes, we offer comprehensive support and maintenance packages to ensure your application remains secure, up-to-date, and running smoothly. Our support team is available 24/7 to address any issues.',
            'order' => 1,
        ]);

        Faq::create([
            'faq_category_id' => $services->id,
            'question' => 'Can you work with our existing technology stack?',
            'answer' => 'Absolutely! We have experience with a wide variety of technologies and can adapt to your existing infrastructure. Our team is skilled in modern frameworks and can seamlessly integrate with your current systems.',
            'order' => 2,
        ]);

        Faq::create([
            'faq_category_id' => $pricing->id,
            'question' => 'How do you structure your pricing?',
            'answer' => 'Our pricing depends on the scope and complexity of the project. We offer both fixed-price and hourly rate options. After our initial consultation, we provide a detailed proposal with transparent pricing.',
            'order' => 1,
        ]);

        Faq::create([
            'faq_category_id' => $pricing->id,
            'question' => 'Do you require a deposit?',
            'answer' => 'Yes, we typically require a 30% deposit to begin work on a project. The remaining balance is paid in milestones or upon project completion, depending on the agreement.',
            'order' => 2,
        ]);
    }
}
