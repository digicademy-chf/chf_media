<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMedia\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractHeritage;
use Digicademy\CHFBase\Domain\Model\Period;
use Digicademy\CHFBase\Domain\Model\Traits\AgentRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LocationRelationTrait;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Attribute\ORM\Cascade;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for FileGroup
 */
class FileGroup extends AbstractHeritage
{
    use AgentRelationTrait;
    use LocationRelationTrait;

    /**
     * Name of this file collection
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

    /**
     * List of all files that are part of this collection
     * 
     * @var ObjectStorage<FileReference>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $portfolio;

    /**
     * Room to list collection-related events
     * 
     * @var ObjectStorage<Period>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ObjectStorage $event;

    /**
     * Construct object
     *
     * @param string $title
     * @return FileGroup
     */
    public function __construct(string $title)
    {
        parent::__construct();
        $this->initializeObject();

        $this->setTitle($title);
        $this->setIri('fg');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->portfolio = new ObjectStorage();
        $this->event = new ObjectStorage();
        $this->agentRelation = new ObjectStorage();
        $this->locationRelation = new ObjectStorage();
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get portfolio
     *
     * @return ObjectStorage<FileReference>
     */
    public function getPortfolio(): ObjectStorage
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
        $this->portfolio->attach($portfolio);
    }

    /**
     * Remove portfolio
     *
     * @param FileReference $portfolio
     */
    public function removePortfolio(FileReference $portfolio): void
    {
        $this->portfolio->detach($portfolio);
    }

    /**
     * Remove all portfolios
     */
    public function removeAllPortfolio(): void
    {
        $portfolio = clone $this->portfolio;
        $this->portfolio->removeAll($portfolio);
    }

    /**
     * Get event
     *
     * @return ObjectStorage<Period>
     */
    public function getEvent(): ObjectStorage
    {
        return $this->event;
    }

    /**
     * Set event
     *
     * @param ObjectStorage<Period> $event
     */
    public function setEvent(ObjectStorage $event): void
    {
        $this->event = $event;
    }

    /**
     * Add event
     *
     * @param Period $event
     */
    public function addEvent(Period $event): void
    {
        $this->event->attach($event);
    }

    /**
     * Remove event
     *
     * @param Period $event
     */
    public function removeEvent(Period $event): void
    {
        $this->event->detach($event);
    }

    /**
     * Remove all events
     */
    public function removeAllEvent(): void
    {
        $event = clone $this->event;
        $this->event->removeAll($event);
    }
}
