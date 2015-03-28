<?php

/**
 * @author Wojciech Brüggemann <wojtek77@o2.pl>
 */
class Loc_My_Validate_LocDate extends Zend_Validate_Abstract {
    
    const TOO_EARLY = 'too_early';
    const NOT_LESS = 'not_less';
    
    protected $dateFrom;
    protected $dateTo;
    
    protected $_messageVariables = array(
        'dateFrom' => 'dateFrom',
        'dateTo' => 'dateTo',
    );
    
    protected $_messageTemplates = array(
        self::TOO_EARLY => "Date '%value%' must be greater or equal than date in 7 days",
        self::NOT_LESS => "Date from '%dateFrom%' must be less than date to '%dateTo%'",
    );

    public function isValid($value, $context = null) {
        
        /* sprawdzanie czy termin nie blizszy niż "za 7 dni") */
        if (!(date('Y-m-d', strtotime('+7 day')) <= $value)) {
            $this->_setValue($value);
            $this->_error(self::TOO_EARLY);
            return false;
        }
        
        /* data "from" musi byc mniejsza od daty "to" */
        if (!empty($context['from']) && !empty($context['to']) && !($context['from'] < $context['to'])) {
            $this->dateFrom = $context['from'];
            $this->dateTo = $context['to'];
            $this->_error(self::NOT_LESS);
            return false;
        }
        
        return true;
    }
}
