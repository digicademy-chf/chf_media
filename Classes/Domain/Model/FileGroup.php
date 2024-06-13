<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMedia\Domain\Model;

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractHeritage;

defined('TYPO3') or die();

/**
 * Model for FileGroup
 */
class FileGroup extends AbstractHeritage
{
    /**
     * Title of this file group
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $name = '';

    /**
     * List of all files that are part of this file group
     * 
     * @var ?ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $portfolio = null;

    /**
     * Construct object
     *
     * @param object $parentResource
     * @param string $uuid
     * @param string $name
     * @return FileGroup
     */
    public function __construct(object $parentResource, string $uuid, string $name)
    {
        parent::__construct($parentResource, $uuid);
        $this->initializeObject();

        $this->setName($name);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->portfolio ??= new ObjectStorage();
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get portfolio
     *
     * @return ObjectStorage<FileReference>
     */
    public function getPortfolio(): ?ObjectStorage
    {
        return $this->portfolio;
    }

    /**
     * Set portfolio
     *
     * @param ObjectStorage<FileReference> $portfolio
     */
    public function setPortfolio(ObjectStorage $portfolio): void
    {
        $this->portfolio = $portfolio;
    }

    /**
     * Add portfolio
     *
     * @param FileReference $portfolio
     */
    public function addPortfolio(FileReference $portfolio): void
    {
        $this->portfolio?->attach($portfolio);
    }

    /**
     * Remove portfolio
     *
     * @param FileReference $portfolio
     */
    public function removePortfolio(FileReference $portfolio): void
    {
        $this->portfolio?->detach($portfolio);
    }

    /**
     * Remove all portfolios
     */
    public function removeAllPortfolio(): void
    {
        $portfolio = clone $this->portfolio;
        $this->portfolio->removeAll($portfolio);
    }
}
