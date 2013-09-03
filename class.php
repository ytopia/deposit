<?php
    class deposit
    {
        const percent = 8;//percent in year
        private $cash; //money
        private $time; //month
        private $capitalization; //money per month
        public function __construct($cash,$time, $capitalization = null)
        {
            try{                
                if($cash!==null && $time!=null)
                {
                    $this->cash = (int)$cash;
                    $this->time = (int)$time;
                    $this->capitalization = (int)$capitalization;       
                }
                else
                {
                    throw new Exeprtion('empty data');
                }
            }
            catch(Exeption $e)
            {
                throw new Exeprtion('Caught exception: ',  $e->getMessage(), "\n");
            }
        
        }
        /*
        * format money
        */
        private function formatMoney($number, $fractional=false) 
        { 
            if ($fractional) { 
                $number = sprintf('%.2f', $number); 
            } 
            while (true) { 
                $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
                if ($replaced != $number) { 
                    $number = $replaced; 
                } else { 
                    break; 
                } 
            } 
            return $number; 
        } 
        /*
        * calc money
        */
        private function percent($sum)
        {
            return (self::percent/1200*$sum)+$sum;
        }
        private function sum($time,$cash,$capitalization)
        {
            for($i=0;$i<$time;++$i)
            {
                $cash= $this->percent($cash);
                if($i>0)
                {
                    $cash += $capitalization;
                }
            }
            return $cash;
        }
        private function result($time, $cash, $capitalization)
        {
            return $this->sum($time,$cash,$capitalization);
        }
        public function prints()
        {
             echo  $this->formatMoney($this->result($this->time,$this->cash,$this->capitalization),true); 
        }
        public function __toString()
        {
            if(isset($this->cash))
                $this->prints();
            else
                echo 'Hello, i`m calculator!';
        }
    }
