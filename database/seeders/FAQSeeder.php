<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FAQ::create([
            'question' => 'What is reach and wash window cleaning?',
            'answer' => 'Reach and wash is a professional window cleaning method that uses purified water and telescopic poles to clean windows safely from the ground. It eliminates the need for ladders, making it ideal for both residential and commercial properties.'
        ]);

        FAQ::create([
            'question' => 'How does the reach and wash system work?',
            'answer' => 'We use purified water that leaves no streaks or spots. The water is pumped through our telescopic poles and brushes, allowing us to clean windows—even on high floors—without the need to climb ladders.'
        ]);

        FAQ::create([
            'question' => 'Is reach and wash safe?',
            'answer' => 'Yes! This method is completely safe for your property, pets, and our team. By working from the ground, we reduce the risk of accidents and avoid damaging your windows, frames, or walls.'
        ]);

        FAQ::create([
            'question' => 'Will my windows be streak-free?',
            'answer' => 'Absolutely. The purified water used in reach and wash leaves windows sparkling clean, free from streaks, spots, or smears.'
        ]);

        FAQ::create([
            'question' => 'Can you clean high or hard-to-reach windows?',
            'answer' => 'Yes. Our telescopic poles can reach up to [insert height, e.g., 60 feet], making it perfect for multi-story homes, offices, or commercial buildings.'
        ]);

        FAQ::create([
            'question' => 'Do I need to move furniture or prepare the area?',
            'answer' => 'No extensive preparation is needed. We may ask you to remove fragile items near windows, but we handle the rest.'
        ]);

        FAQ::create([
            'question' => 'Is the water environmentally friendly?',
            'answer' => 'Yes. We use 100% purified water with no chemicals, making it safe for plants, pets, and the environment.'
        ]);

        FAQ::create([
            'question' => 'How often should windows be cleaned?',
            'answer' => 'It depends on your location and environment. For most homes, every 3–6 months is ideal. Commercial properties may require more frequent cleaning. We can recommend a schedule tailored to your needs.'
        ]);

        FAQ::create([
            'question' => 'Do you also clean frames, sills, and screens?',
            'answer' => 'Yes, we can clean window frames, sills, and screens upon request. This ensures a complete, polished finish.'
        ]);

        FAQ::create([
            'question' => 'How much does reach and wash window cleaning cost?',
            'answer' => 'Pricing depends on the number, size, and accessibility of your windows. Contact us for a free, no-obligation quote.'
        ]);

        FAQ::create([
            'question' => 'Are you insured?',
            'answer' => 'Yes. We are fully insured, giving you peace of mind while we work on your property.'
        ]);

        FAQ::create([
            'question' => 'Can you clean on rainy or windy days?',
            'answer' => 'Rain can affect results, so we usually reschedule in heavy rain. Light wind is generally fine, but extreme weather may impact safety and quality.'
        ]);

        FAQ::create([
            'question' => 'How do I book an appointment?',
            'answer' => 'You can contact us via phone, email, or our website. We will schedule a convenient time and provide a free quote if needed.'
        ]);

        FAQ::create([
            'question' => 'What areas do you serve?',
            'answer' => 'We provide window cleaning services in Blaydon, Whickham, Ryton, Rowlands Gill and the surrounding areas. Contact us if your location is not listed—we may still be able to help!'
        ]);
    }
}

