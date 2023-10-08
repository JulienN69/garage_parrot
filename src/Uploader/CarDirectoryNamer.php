<?php

namespace App\Uploader;

use App\Entity\Car;
use App\Entity\CarPictures;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class CarDirectoryNamer implements DirectoryNamerInterface
{
    public function directoryName($object, PropertyMapping $mapping): string
    {
        if ($object instanceof CarPictures) {
            $car = $object->getRepresentedBy();
        } elseif ($object instanceof Car) {
            $car = $object;
        } else {
            return 'autres'; 
        }

        if ($car) { 
            $modele = $car->getModele();

            if ($modele) { 
                $modele = substr($modele, 0, 10);
                $modele = str_replace(' ', '', $modele);
                $existingDirectory = $this->getExistingDirectory($modele);

                if ($existingDirectory) {
                    return $existingDirectory;
                }
                return $modele . $car->getId();
            }
        }

        return 'autres';
    }
    private function getExistingDirectory($modele)
    {

        $storageDirectory = '%kernel.project_dir%/public/images/cars';
        $directoryToCheck = $storageDirectory . '/' . $modele;

        if (is_dir($directoryToCheck)) {
            return $modele;
        }

        return null;
    }
}


