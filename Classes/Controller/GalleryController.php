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
use TYPO3\CMS\Core\Cache\CacheTag;
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

    /**
     * Show file and file group list
     *
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        // Get resource
        $resourceIdentifier = $this->settings['resource'];
        $this->view->assign('resource', $this->abstractResourceRepository->findByIdentifier($resourceIdentifier));

        // Set cache tag
        $cacheDataCollector = $this->request->getAttribute('frontend.cache.collector');
        $cacheDataCollector->addCacheTags(
            new CacheTag('chf')
        );

        // Create response
        return $this->htmlResponse();
    }

    /**
     * Show single file
     *
     * @param File $singleFile
     * @return ResponseInterface
     */
    public function showAction(File $singleFile): ResponseInterface
    {
        // Get single file
        $this->view->assign('singleFile', $singleFile);

        // Set cache tag
        $cacheDataCollector = $this->request->getAttribute('frontend.cache.collector');
        $cacheDataCollector->addCacheTags(
            new CacheTag('chf')
        );

        // Create response
        return $this->htmlResponse();
    }

    /**
     * Show single file group
     *
     * @param FileGroup $fileGroup
     * @return ResponseInterface
     */
    public function showGroupAction(FileGroup $fileGroup): ResponseInterface
    {
        // Get file group
        $this->view->assign('fileGroup', $fileGroup);

        // Set cache tag
        $cacheDataCollector = $this->request->getAttribute('frontend.cache.collector');
        $cacheDataCollector->addCacheTags(
            new CacheTag('chf')
        );

        // Create response
        return $this->htmlResponse();
    }
}
