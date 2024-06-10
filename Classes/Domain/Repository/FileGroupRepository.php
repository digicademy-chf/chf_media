<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMedia\Domain\Repository;

use Digicademy\CHFMedia\Domain\Model\FileGroup;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

defined('TYPO3') or die();

/**
 * Repository for FileGroup
 * 
 * @extends Repository<FileGroup>
 */
class FileGroupRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'     => QueryInterface::ORDER_ASCENDING,
        'isHighlight' => QueryInterface::ORDER_ASCENDING,
        'name'        => QueryInterface::ORDER_ASCENDING,
    ];
}
