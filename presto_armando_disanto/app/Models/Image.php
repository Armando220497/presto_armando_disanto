<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage; // Per gestire i file nel sistema di storage
use App\Models\Article;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path', // Campo per l'assegnazione di massa
    ];

    // Definizione della relazione con l'articolo
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    // Funzione per ottenere l'URL del file (con o senza ridimensionamento)
    public static function getUrlByFilePath($filePath, $w = null, $h = null)
    {
        // Se non vengono passati larghezza e altezza, ritorna il file originale
        if (!$w && !$h) {
            return Storage::url($filePath);
        }

        // Calcola il percorso del file ridimensionato
        $path = dirname($filePath);
        $filename = basename($filePath);
        $file = "{$path}/crop_{$w}x{$h}_{$filename}";

        // Verifica se il file ridimensionato esiste
        if (Storage::exists($file)) {
            return Storage::url($file);
        }

        // Se il file non esiste, ritorna l'originale
        return Storage::url($filePath);
    }

    // Metodo per chiamare la funzione statica per ottenere l'URL dell'immagine
    public function getUrl($w = null, $h = null)
    {
        return self::getUrlByFilePath($this->path, $w, $h);
    }

    protected function casts(): array
    {
        return [
            'labels' => 'array',
        ];
    }
}
