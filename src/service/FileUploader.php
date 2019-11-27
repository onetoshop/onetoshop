<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\File;

class FileUploader
{
    private $name;
    private $filename;

    public function __construct($targetDirectory, ApplicationHandler $applicationHandler, ParameterBagInterface $params, TokenStorageInterface $tokenStorage)
    {
        $this->targetDirectory = $targetDirectory;
        $this->applicationHandler = $applicationHandler;
        $this->params = $params;
        $this->name = $tokenStorage->getToken()->getN();
    }

    public function upload(UploadedFile $file)
    {
        $mimeType = $file->getMimetype();
        $fileSize = $file->getSize();
        $originalName = $file->getClientOriginalName();
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            # implement logger
        }

        # create a new file
        $fileEntity = new File();

        # set application
        $fileEntity->setApplication($this->applicationHandler->getApplication());

        # set user id
        $fileEntity->setUserId($this->user->getId());

        # set path
        $fileEntity->setPath($this->params->get('uploadsdir'));

        # set originalName
        $fileEntity->setOriginalName($originalName);

        # set name
        $fileEntity->setName($fileName);

        # set mime type
        $fileEntity->setMimeType($mimeType);

        # set size
        $fileEntity->setSize($fileSize);

        return $fileEntity;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
