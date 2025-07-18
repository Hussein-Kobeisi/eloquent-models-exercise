<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $modelTypes = ["GPT-4", "Claude 3", "Gemini 1.5", "LLaMA 3", "Mistral 7B", "Command R+", "Yi 34B", "Mixtral 8x7B", "BERT", "RoBERTa", "T5", "XLNet", "DistilBERT", "ALBERT", "YOLOv5", "YOLOv8", "ResNet", "EfficientNet", "Vision Transformer (ViT)", "SAM (Segment Anything)", "Whisper", "WaveNet", "HuBERT", "DeepSpeech", "GPT-4o", "Flamingo", "Grok", "AlphaGo", "AlphaZero", "OpenAI Five", "MuZero"];

        return [
            'name' => $this->faker->name(),
            'model_type' => $modelTypes[rand(0,count($modelTypes)-1)],
            'version' => 'v'.$this->faker->randomDigit().'.'.$this->faker->randomDigit(),
            'active' =>  rand(0,1)<.5
        ];
    }
}
