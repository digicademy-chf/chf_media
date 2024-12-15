<?php
declare(strict_types=1);

# This file is part of the extension CHF Media for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFMedia\EventListener;

use TYPO3\CMS\Core\Resource\Event\AfterFileMetaDataCreatedEvent;

defined('TYPO3') or die();

/**
 * Extract metadata via ExifTool if available
 */
final class ExiftoolFileMetadataExtraction
{
    public function __invoke(AfterFileMetaDataCreatedEvent $event): void
    {
        $record = $event->getRecord();
        $record['caption'] = 'I am a sample caption.';
        $event->setRecord($record);
    }
}
