<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMedia\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractResource;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Domain\Model\Folder;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

defined('TYPO3') or die();

/**
 * Model for MediaResource
 */
class MediaResource extends AbstractResource
{
    /**
     * Folder holding the relevant media files
     * 
     * @var Folder|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected Folder|LazyLoadingProxy|null $fileStorage = null;

    /**
     * Construct object
     *
     * @param string $langCode
     * @return MediaResource
     */
    public function __construct(string $langCode)
    {
        parent::__construct($langCode);
        
        $this->setType('mediaResource');
    }

    /**
     * Get file storage
     * 
     * @return Folder
     */
    public function getFileStorage(): Folder
    {
        if ($this->fileStorage instanceof LazyLoadingProxy) {
            $this->fileStorage->_loadRealInstance();
        }
        return $this->fileStorage;
    }

    /**
     * Set file storage
     * 
     * @param Folder
     */
    public function setFileStorage(Folder $fileStorage): void
    {
        $this->fileStorage = $fileStorage;
    }
}
