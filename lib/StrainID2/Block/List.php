<?php

/**
 * StrainID2
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 */
class StrainID2_Block_List extends Zikula_Controller_AbstractBlock
{

    /**
     * initialise block
     */
    public function init()
    {
        SecurityUtil::registerPermissionSchema('StrainID2:listblock:', 'Block title::');
    }

    /**
     * get block information
     */
    public function info()
    {
        return array(
            'text_type' => 'StrainID2',
            'module' => 'StrainID2',
            'text_type_long' => $this->__('StrainID2 list Block'),
            'allow_multiple' => true,
            'form_content' => false,
            'form_refresh' => false,
            'show_preview' => true);
    }

    /**
     * display block
     */
    public function display($blockinfo)
    {
        if (!SecurityUtil::checkPermission('StrainID2:listblock:', "$blockinfo[title]::", ACCESS_OVERVIEW)) {
            return;
        }
        if (!ModUtil::available('StrainID2')) {
            return;
        }
        // Get variables from content block
        $vars = BlockUtil::varsFromContent($blockinfo['content']);

        // return if no category
        if (empty($vars['category'])) {
            return;
        }

        $strains = ModUtil::apiFunc('StrainID2', 'user', 'getall', array(
                    'category' => $vars['category'],
                    'limit' => $vars['limit'],
                    'orderby' => 'date',
                    'orderdir' => 'DESC',
                ));

        // create the output object
        $this->view->setCacheId('listblock' . '|' . $blockinfo['bid'] . "|" . $vars['category']);

        // assign the item
        $this->view->assign('strains', $strains);

        // Populate block info and pass to theme
        $blockinfo['content'] = $this->view->fetch('blocks/list.tpl');
        return BlockUtil::themeBlock($blockinfo);
    }

}