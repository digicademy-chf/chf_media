<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMedia\Controller;

use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Domain\Model\File;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Gallery
 */
class GalleryController extends ActionController
{
    private AbstractResourceRepository $abstractResourceRepository;

    public function injectAbstractResourceRepository(AbstractResourceRepository $abstractResourceRepository): void
    {
        $this->abstractResourceRepository = $abstractResourceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $resourceIdentifier = $this->settings['resource'];
        $this->view->assign('resource', $this->abstractResourceRepository->findByIdentifier($resourceIdentifier));
        return $this->htmlResponse();
    }

    public function showSingleAction(File $singleFile): ResponseInterface
    {
        $this->view->assign('singleFile', $singleFile);
        return $this->htmlResponse();
    }

    public function showGroupAction(FileGroup $fileGroup): ResponseInterface
    {
        $this->view->assign('fileGroup', $fileGroup);
        return $this->htmlResponse();
    }
}
