<?php

namespace App\Pattern\Ujian;

class SoalFlyweight
{
    private string $tag;
    private string $text;
    private array $options;
    private string $correct;
    private string $explanation;

    public function __construct(string $tag, string $text, array $options, string $correct, string $explanation)
    {
        $this->tag = $tag;
        $this->text = $text;
        $this->options = $options;
        $this->correct = $correct;
        $this->explanation = $explanation;
    }

    /**
     * Menggabungkan intrinsic state (soal) dengan extrinsic state (ID/urutan soal)
     */
    public function render(int $id, string $prefix = "Soal No. "): array
    {
        $renderedText = $prefix . $id;
        if (!empty($this->tag)) {
            $renderedText .= " [{$this->tag}]";
        }
        $renderedText .= ": " . $this->text;

        return [
            'id' => $id,
            'text' => $renderedText,
            'options' => $this->options,
            'correct' => $this->correct,
            'explanation' => $this->explanation,
        ];
    }
}
