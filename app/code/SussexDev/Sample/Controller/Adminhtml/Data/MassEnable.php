<?php
/*
 * SussexDev_Sample

 * @category   SussexDev
 * @package    SussexDev_Sample
 * @copyright  Copyright (c) 2018 Scott Parsons
 * @license    https://github.com/ScottParsons/module-sampleuicomponent/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace SussexDev\Sample\Controller\Adminhtml\Data;

use SussexDev\Sample\Model\Data;

class MassEnable extends MassAction
{
    /**
     * @param Data $data
     * @return $this
     */
    protected function massAction(Data $data)
    {
        $data->setIsActive(true);
        $this->dataRepository->save($data);
        return $this;
    }
}
