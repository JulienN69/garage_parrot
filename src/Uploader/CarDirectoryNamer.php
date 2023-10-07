<?php

namespace App\Uploader;

use App\Entity\CarPictures;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class CarDirectoryNamer implements DirectoryNamerInterface
{
    public function directoryName($carPictures, PropertyMapping $mapping): string
    {

        if ($carPictures instanceof CarPictures) {
            $car = $carPictures->getRepresentedBy();

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
        }

        return 'autres';
    }
    private function getExistingDirectory($modele)
    {
        // Vous devez implémenter la logique pour vérifier si le répertoire existe déjà
        // Retournez le nom du répertoire existant s'il est trouvé, sinon null
        // Par exemple, vous pouvez vérifier s'il existe déjà un répertoire avec ce nom
        // dans le répertoire de stockage configuré.
        // Notez que la logique spécifique dépendra de votre configuration de stockage.
        
        // Exemple de logique de vérification de l'existence du répertoire (à personnaliser)
        $storageDirectory = '%kernel.project_dir%/public/images/cars';
        $directoryToCheck = $storageDirectory . '/' . $modele;

        if (is_dir($directoryToCheck)) {
            return $modele;
        }

        return null;
    }
}


