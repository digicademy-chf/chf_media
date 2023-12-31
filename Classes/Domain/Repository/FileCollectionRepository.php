<?php

declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMedia\Domain\Repository;

use Digicademy\CHFMedia\Domain\Model\FileCollection;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for FileCollection
 * 
 * @extends Repository<FileCollection>
 */
class FileCollectionRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'          => QueryInterface::ORDER_ASCENDING,
        'itemTitle'        => QueryInterface::ORDER_ASCENDING,
        'publicationTitle' => QueryInterface::ORDER_ASCENDING,
        'seriesTitle'      => QueryInterface::ORDER_ASCENDING,
        'meetingTitle'     => QueryInterface::ORDER_ASCENDING,
    ];
}

?>
