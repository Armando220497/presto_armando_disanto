<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Image;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionLabelImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $article_image_id;

    public function __construct($article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }

    public function handle(): void
    {
        // Trova l'immagine nel database
        $image = Image::find($this->article_image_id);
        if (!$image) {
            return; // Se l'immagine non esiste, esci
        }

        // Ottieni il contenuto dell'immagine
        $imagePath = storage_path('app/public/' . $image->path);
        if (!file_exists($imagePath)) {
            return; // Se il file non esiste, esci
        }

        $imageContent = file_get_contents($imagePath);
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credentials.json'));

        // Inizializza il client Google Vision
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->labelDetection($imageContent);
        $labels = $response->getLabelAnnotations();

        if ($labels) {
            // Crea un array per i risultati delle etichette
            $result = [];
            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }
            $image->labels = json_encode($result); // Salva le etichette come JSON nel campo labels
        }

        $image->save(); // Salva l'immagine con le nuove etichette
        $imageAnnotator->close(); // Chiudi il client
    }
}
