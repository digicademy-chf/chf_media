<?php

declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMedia\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFMedia\Domain\Model\FileCollection;
use Digicademy\CHFMedia\Domain\Repository\FileCollectionRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for FileCollection
 */
class FileCollectionController extends ActionController
{
    private FileCollectionRepository $fileCollectionRepository;

    public function injectFileCollectionRepository(FileCollectionRepository $fileCollectionRepository): void
    {
        $this->fileCollectionRepository = $fileCollectionRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('fileCollections', $this->fileCollectionRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(FileCollection $fileCollection): ResponseInterface
    {
        $this->view->assign('fileCollection', $fileCollection);
        return $this->htmlResponse();
    }
}

?>
