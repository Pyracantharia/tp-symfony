<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    public function __construct(
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire('%kernel.project_dir%/public')] private string $targetDirectory,
        private SluggerInterface $slugger,
        private LoggerInterface  $logger,
    ) {
    }

    public function upload(UploadedFile $file, $folder = '/uploads'): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = strtolower($this->slugger->slug($originalFilename));
        $fileName = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        try {
            $file->move($this->targetDirectory . $folder, $fileName);
        } catch (FileException $e) {
            $this->logger->error('An error occurred while uploading the file: ' . $e->getMessage());
            throw $e;
        }

        return $folder . '/' . $fileName;
    }
}
