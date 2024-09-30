<?php

namespace App\Jobs;

use App\Models\Image;
use Spatie\Image\Enums\Fit;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Spatie\Image\Enums\AlignPosition;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class RemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $article_image_id;

    public function __construct($article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }

    public function handle()
    {
        $imageModel = Image::find($this->article_image_id);
        if (!$imageModel) {
            return; // Se l'immagine non viene trovata, esci dal metodo.
        }

        $srcPath = storage_path('app/public/' . $imageModel->path);
        if (!file_exists($srcPath)) {
            return; // Se il file non esiste, esci dal metodo.
        }

        $image = file_get_contents($srcPath);

        // Imposta le credenziali per Google Cloud
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path("google_credential.json"));

        $imageAnnotator = new ImageAnnotatorClient();
        try {
            $response = $imageAnnotator->faceDetection($image);
            $faces = $response->getFaceAnnotations();

            foreach ($faces as $face) {
                $vertices = $face->getBoundingPoly()->getVertices();
                $bounds = []; // Inizializza l'array $bounds

                foreach ($vertices as $vertex) {
                    $bounds[] = [$vertex->getX(), $vertex->getY()]; // Usa $bounds
                }

                if (count($bounds) >= 4) { // Assicurati di avere abbastanza vertici
                    $w = $bounds[2][0] - $bounds[0][0];
                    $h = $bounds[2][1] - $bounds[0][1];

                    $spatieImage = SpatieImage::load($srcPath); // Corretto da $Image a $spatieImage

                    $spatieImage->watermark(
                        base_path("resources/img/smile.png"),
                        AlignPosition::TopLeft,
                        paddingX: $bounds[0][0],
                        paddingY: $bounds[0][1],
                        width: $w,
                        height: $h,
                        fit: Fit::Stretch
                    );

                    $spatieImage->save($srcPath); // Salva l'immagine modificata
                }
            }
        } finally {
            $imageAnnotator->close(); // Assicurati di chiudere il client
        }
    }
}
