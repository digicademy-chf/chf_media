<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMedia\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFMedia\Domain\Model\FileGroup;
use Digicademy\CHFMedia\Domain\Repository\FileGroupRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for FileGroup
 */
class FileGroupController extends ActionController
{
    private FileGroupRepository $fileGroupRepository;

    public function injectFileGroupRepository(FileGroupRepository $fileGroupRepository): void
    {
        $this->fileGroupRepository = $fileGroupRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('fileGroups', $this->fileGroupRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(FileGroup $fileGroup): ResponseInterface
    {
        $this->view->assign('fileGroup', $fileGroup);
        return $this->htmlResponse();
    }
}
