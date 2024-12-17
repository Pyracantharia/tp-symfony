<?php


namespace App\Controller;

use App\Entity\Upload;
use App\Repository\UploadRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN")]
class UploadController extends AbstractController
{
    #[Route('/upload', name: 'app_upload')]
    public function index(UploadRepository $uploadRepository): Response
    {
        $uploads = $uploadRepository->findAll();

        return $this->render('upload.html.twig', [
            'uploads' => $uploads,
        ]);
    }

    #[Route('/api/upload', name: 'api_upload', methods: ['POST'])]
    public function uploadApi(
        Request $request,
        FileUploader $fileUploader,
        EntityManagerInterface $entityManager
    ): Response {
        $files = $request->files->all()['files'] ?? [];

        foreach ($files as $file) {
            $fileName = $fileUploader->upload($file);
            $upload = new Upload();
            $upload->setUploadedBy($this->getUser());
            $upload->setUrl($fileName);
            $entityManager->persist($upload);
        }

        $entityManager->flush();

        return $this->json(['message' => 'Upload successful!']);
    }
}
