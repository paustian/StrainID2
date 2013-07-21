<?php


class StrainID2_Form_Handler_User_Search extends Zikula_Form_AbstractHandler {

    /**
     * Initialize form handler.
     *
     * This method takes care of all necessary initialisation of our data and form states.
     *
     * @return boolean False in case of initialization errors, otherwise true.
     */
    public function initialize(Zikula_Form_View $view) {
        parent::initialize($view);
        //initialize the drop down menu choices. This will get used for all the strains choices
        $reaction = array(array('text' => '+', 'value' => '+'),
            array('text' => '-', 'value' => '-'),
            array('text' => 'u', 'value' => 'u'));
        $strain_table = SessionUtil::getVar('search_results');
        $view->assign('strain_table', $strain_table);
        $view->assign('reaction', $reaction); // Supply items
        // everything okay, no initialization errors occured
        return true;
    }

    public function handleCommand(Zikula_Form_View $view, &$args) {
        if ($args['commandName'] == 'cancel') {
            $url = ModUtil::url('StrainID2', 'user', 'view');
            return $this->view->redirect($url);
        }
        if ($args['commandName'] == 'search') {

            //get the values from the form as an array
            $result = $view->getValues();
            $indole = $result['strain']['indole'];
            $methyl_red = $result['strain']['methylred'];
            $voges_pros = $result['strain']['voguesproskauer'];
            $citrate = $result['strain']['simmonscitrate'];
            $h2s = $result['strain']['h2s'];
            $phenylalanine = $result['strain']['phenylalanine'];
            $ornithine = $result['strain']['ornithine'];
            $motility = $result['strain']['motility'];
            $lactose = $result['strain']['lactose'];
            $lysine = $result['strain']['lysine'];

            $where = array();


            if ($indole == 'u') {
                $where['indole'] = "+|-|u|v";
            } else {
                $where['indole'] = "$indole|u|v";
            }
            if ($methyl_red == 'u') {
                $where['methylred'] = "+|-|u|v";
            } else {
                $where['methylred'] = "$methyl_red|u|v";
            }
            if ($voges_pros == 'u') {
                $where['voguesproskauer'] = "+|-|u|v";
            } else {
                $where['voguesproskauer'] = "$voges_pros|u|v";
            }
            if ($citrate == 'u') {
                $where['simmonscitrate'] = "+|-|u|v";
            } else {
                $where['simmonscitrate'] = "$citrate|u|v";
            }
            if ($h2s == 'u') {
                $where['h2s'] = "+|-|u|v";
            } else {
                $where['h2s'] = "$h2s|u|v";
            }
            if ($phenylalanine == 'u') {
                $where['phenylalanine'] = "+|-|u|v";
            } else {
                $where['phenylalanine'] = "$phenylalanine|u|v";
            }
            if ($ornithine == 'u') {
                $where['ornithine'] = "+|-|u|v";
            } else {
                $where['ornithine'] = "$ornithine|u|v";
            }
            if ($motility == 'u') {
                $where['motility'] = "+|-|u|v";
            } else {
                $where['motility'] = "$motility|u|v";
            }
            if ($lactose == 'u') {
                $where['lactose'] = "+|-|u|v";
            } else {
                $where['lactose'] = "$lactose|u|v";
            }
            if ($lysine == 'u') {
                $where['lysine'] = "+|-|u|v";
            } else {
                $where['lysine'] = "$lysine|u|v";
            }
            
            $repository = $this->entityManager->getRepository('StrainID2_Entity_StrainID2');
            $strains = $repository->selectSearchAnd($where, 'name');
            //Now assign this to a template variable
            $view->assign('strains', $strains);
            $view->assign('is_admin', $do_edit_links);
            //create the strain table.
            $strain_table = $view->fetch('user/strainTbl.tpl');
            //we need to pass this information to the page that will render this
            //This will save it over the session.
            SessionUtil::setVar('search_results', $strain_table);
        }
        $url = ModUtil::url('StrainID2', 'user', 'search');
        return $this->view->redirect($url);
    }
}
?>
