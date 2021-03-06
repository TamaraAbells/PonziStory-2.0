<?php
class Plan_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }

    public function create($data) {
        $this->db->insert('plan', $data);
        return $this->db->insert_id();
    }

    public function checkplanexist($id) {
        return $this->db->from('plan')
            ->where('user_id', $id)
            ->where('status <', '5')
            ->where('recom', NULL)
            ->get()->num_rows();
    }

    public function getNextPlan($id) {
        return $this->db->select('amount,rec_amount')
            ->from('plan')
            ->where('id', $id)
            ->where('status', 1)
            ->get()->row();
    }


    public function check4Recom($id) {
        return $this->db->from('plan')
            ->where('user_id', $id)
            ->where('recom', NULL)
            ->where('status <', '4')
            ->get()->num_rows();
    }
    public function checkplanexistRecom($id) {
        return $this->db->from('plan')
            ->where('user_id', $id)
            ->where('status <', '5')
            ->where('recom', '1')
            ->get()->num_rows();
    }

    public function checkplanexistByUsername($username) {
        return $this->db->from('plan')
            ->where('username', $username)
            ->where('status', '4')
            ->get()->num_rows();
    }

    public function checkplanexist2($id) {
        return $this->db->from('plan')
            ->where('user_id', $id)
            ->where('status <', '5')
            ->where('amount <', '10000')
            ->get()->num_rows();
    }

//    public function checkplan4GH($id) {
//        return $this->db->from('plan')
//            ->where('user_id', $id)
//            ->where('status', '4')
//            ->get()->num_rows();
//    }


    public function getAllplanstats() {
        return $this->db->from('plan')
            ->where('status', 1)
            ->where('rem_amount >', 0)
            ->get()->num_rows();
    }

    public function getAllplanstatsToday($date) {
        return $this->db->from('plan')
            ->where('status', 1)
            ->where('rem_amount >', 0)
            ->where('date_of_plan', $date)
            ->get()->num_rows();
    }

    public function getAllSumplanstats() {
        return $this->db->select('sum(amount) total', FALSE)
            ->from('plan')
            ->where('status', 1)
            ->where('rem_amount >', 0)
            ->get()->row()->total;
    }

    public function getAllSumplanstatsToday($date) {
        return $this->db->select('sum(amount) total', FALSE)
            ->from('plan')
            ->where('status', 1)
            ->where('rem_amount >', 0)
            ->where('date_of_plan', $date)
            ->get()->row()->total;
    }

    public function upAll($id){
        // $cd = (int) $cd;

        $this->db->query("UPDATE plan SET system_bonus_status = 2 WHERE user_id = $id ");
        return TRUE;
    }


    public function getPlan2($id) {
        return $this->db->select('amount')
            ->from('plan')
            ->where('user_id', $id)
            ->where('status', 4)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function getPlan($id) {
        return $this->db->select('amount')
            ->from('plan')
            ->where('id', $id)
            ->get()->row();
    }

    public function getStatus($id) {
        return $this->db->select('status,amount')
            ->from('plan')
            ->where('user_id', $id)
            ->where('recom', NULL)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function getStatus2($id) {
        return $this->db->select('status,amount')
            ->from('plan')
            ->where('user_id', $id)
            ->where('recom', 1)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function getZaplan($id) {
        return $this->db->select('id,status,rem_amount')
            ->from('plan')
            ->where('status', 1)
            ->where('user_id', $id)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function getAllplan($id) {
        return $this->db->select('id,user_id,status,amount,rem_amount,date_of_plan,date_of_gh,recom')
            ->from('plan')
            ->where('status >', 0)
            ->where('user_id', $id)
            ->order_by('id', 'DESC')
            ->get()->result();
    }

    public function getAllplan2($id) {
        return $this->db->select('id,user_id,status,amount,rem_amount,date_of_plan,date_of_gh,recom')
            ->from('plan')
            ->where('status >', 0)
            ->where('id', $id)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function getProblemplan($id) {
        return $this->db->select('id,status,rem_amount')
            ->from('plan')
            ->where('status', 6)
            ->where('user_id', $id)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function getplan4Merge($amt=0,$limit = 10,$recom=NULL) {
        if ($amt == 0){
            return $this->db->select('user_id,p.username,recom,rem_amount,date_of_plan,date_of_gh,status')
                ->from('plan p')
                ->join('users u', 'u.id = p.user_id')
                ->where('p.status', 1)
                ->where('p.rem_amount >', 0)
                ->where('u.locked', 0)
                ->where('u.active', 1)
                ->where('u.deleted', 0)
                ->order_by('rem_amount', 'ASC')
                ->order_by('date_of_plan', 'ASC')
                ->order_by('p.id', 'ASC')
                ->limit($limit)
                ->get()->result();
        }
        elseif ($amt > 1 && $recom=="1"){
            return $this->db->select('user_id,p.username,recom,rem_amount,date_of_plan,date_of_gh,status')
                ->from('plan p')
                ->join('users u', 'u.id = p.user_id')
                ->where('p.status', 1)
                ->where('p.recom', 1)
                ->where('p.rem_amount >', 0)
                ->where('p.rem_amount', $amt)
                ->where('u.locked', 0)
                ->where('u.active', 1)
                ->where('u.deleted', 0)
                ->order_by('rem_amount', 'DESC')
                ->order_by('date_of_plan', 'ASC')
                ->order_by('p.id', 'ASC')
                ->limit($limit)
                ->get()->result();
        }

        elseif ($amt > 1 && $recom == "0"){
            return $this->db->select('user_id,p.username,recom,rem_amount,date_of_plan,date_of_gh,status')
                ->from('plan p')
                ->join('users u', 'u.id = p.user_id')
                ->where('p.status', 1)
                ->where('p.recom', NULL)
                ->where('p.rem_amount >', 0)
                ->where('p.rem_amount', $amt)
                ->where('u.locked', 0)
                ->where('u.active', 1)
                ->where('u.deleted', 0)
                ->order_by('rem_amount', 'DESC')
                ->order_by('date_of_plan', 'ASC')
                ->order_by('p.id', 'ASC')
                ->limit($limit)
                ->get()->result();
        }

        else{
            return $this->db->select('user_id,p.username,recom,rem_amount,date_of_plan,date_of_gh,status')
                ->from('plan p')
                ->join('users u', 'u.id = p.user_id')
                ->where('p.status', 1)
                ->where('p.rem_amount >', 0)
                ->where('p.rem_amount', $amt)
                ->where('u.locked', 0)
                ->where('u.active', 1)
                ->where('u.deleted', 0)
                ->order_by('rem_amount', 'DESC')
                ->order_by('date_of_plan', 'ASC')
                ->order_by('p.id', 'ASC')
                ->limit($limit)
                ->get()->result();
        }
    }

    public function getplan4MergeSingle($id) {
        return $this->db->select('user_id,username,rem_amount,date_of_plan,date_of_gh,status')
            ->from('plan')
            ->where('status', 1)
            ->where('rem_amount >', 0)
            ->where('user_id', $id)
            ->order_by('rem_amount', 'DESC')
            ->order_by('date_of_plan', 'ASC')
            ->order_by('id', 'ASC')
            ->limit(1)
            ->get()->row();
    }

    public function getplan4MergeSingleBonus($id) {
        return $this->db->select('user_id,username,rem_amount,date_of_plan,date_of_gh,status')
            ->from('plan')
            ->where('status', 1)
            ->where('rem_amount >', 0)
            ->where('user_id', $id)
            ->order_by('rem_amount', 'DESC')
            ->order_by('date_of_plan', 'ASC')
            ->order_by('id', 'ASC')
            ->limit(1)
            ->get()->row();
    }

    public function getplan4Gh() {
        return $this->db->select('user_id,username,rem_amount,date_of_gh,status')
            ->from('plan')
            ->where('status', 4)
            ->where('rem_amount >', 0)
            ->order_by('id', 'DESC')
            ->get()->result();
    }

    public function getLastRecom($id) {
        return $this->db->select('id,amount,date_of_gh')
            ->from('plan')
            ->where('user_id', $id)
            ->where('status', '5')
            ->where('recom', 1)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function getLastReplan($id) {
        return $this->db->select('id,amount,date_of_gh')
            ->from('plan')
            ->where('user_id', $id)
            ->where('status', '5')
            ->where('recom', NULL)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function getLastplan($id) {
        return $this->db->select('id,amount,date_of_gh')
            ->from('plan')
            ->where('user_id', $id)
            ->where('status', '4')
            ->where('recom', NULL)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function getLastplan2($id) {
        return $this->db->select('id,amount,date_of_gh')
            ->from('plan')
            ->where('user_id', $id)
            ->where('status', '4')
            ->where('recom', 1)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }

    public function checkGhDate($id) {
        return $this->db->select('date_of_gh,amount')
            ->from('plan')
            ->where('user_id', $id)
            ->where('recom', NULL)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row();
    }


    public function getFirstLevelBonus($id,$limit=5) {
        return $this->db->select('user_id,username,first_bonus_status,first_bonus_id,amount,rem_amount,date_of_gh,status')
            ->from('plan')
            ->where('status <', 5)
            ->where('first_bonus_status', 1)
            ->where('first_bonus_id', $id)
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->get()->result();
    }

    public function getFirstLevelTotal($id)
    {
        return $this->db->select('sum(amount) total', FALSE)
            ->from('plan')
            ->where('status <', 5)
            ->where('first_bonus_status', 1)
            ->where('first_bonus_id', $id)
            ->get()->row()->total;
    }

    public function getSecondLevelBonus($id,$limit=5) {
        return $this->db->select('user_id,username,second_bonus_status,second_bonus_id,amount,rem_amount,date_of_gh,status')
            ->from('plan')
            ->where('status <', 5)
            ->where('second_bonus_status', 1)
            ->where('second_bonus_id', $id)
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->get()->result();
    }

    public function getSecondLevelTotal($id)
    {
        return $this->db->select('sum(amount) total', FALSE)
            ->from('plan')
            ->where('status <', 5)
            ->where('second_bonus_status', 1)
            ->where('second_bonus_id', $id)
            ->order_by('id', 'DESC')
            ->get()->row()->total;
    }

    public function countFbl($id) {
        return $this->db->select("count(*) c", FALSE)
            ->from('plan')
            ->where('status <', 5)
            ->where('first_bonus_status', 1)
            ->where('first_bonus_id', $id)
            ->order_by('id', 'DESC')
            ->get()->row()->c;
    }

    public function countSysBonus($id) {
        return $this->db->select("count(*) c", FALSE)
            ->from('plan')
            ->where('system_bonus_status ', 1)
            ->where('recom ', NULL)
            ->where('status > ', 3)
            ->where('status < ', 6)
            ->where('user_id', $id)
            ->order_by('id', 'ASC')
            ->get()->row()->c;
    }

    public function sysBonusTotal($id)
    {
        //get las 5
        return $this->db->select('sum(amount) total', FALSE)
            ->from('plan')
            ->where('system_bonus_status ', 1)
            ->where('recom ', NULL)
            ->where('status > ', 3)
            ->where('status < ', 6)
            ->where('user_id', $id)
            ->order_by('id', 'ASC')
            ->limit(5)
            ->get()->row()->total;
    }

    public function getSysBonus($id)
    {
        //get las 5
        return $this->db->select('amount', FALSE)
            ->from('plan')
            ->where('system_bonus_status ', 1)
            ->where('recom ', NULL)
            ->where('status > ', 3)
            ->where('status < ', 6)
            ->where('user_id', $id)
            ->order_by('id', 'ASC')
            ->limit(5)
            ->get()->row();
    }


    public function getAvailbleBonusSumFirst($id)
    {
        return $this->db->select('sum(amount) total', FALSE)
            ->from('plan')
            ->where('status', 4)
            ->where('first_bonus_status', 1)
            ->where('first_bonus_id', $id)
            ->get()->row()->total;
    }

    public function getAvailbleBonusSumSecond($id)
    {
        return $this->db->select('sum(amount) total', FALSE)
            ->from('plan')
            ->where('status', 4)
            ->where('second_bonus_status', 1)
            ->where('second_bonus_id', $id)
            ->get()->row()->total;
    }

    public function getAvailableSumTotal($id){
        $f = $this->getAvailbleBonusSumFirst($id) * 0.05;
        $s =  $this->getAvailbleBonusSumSecond($id) * 0.025;
        return $f + $s;
    }



    public function getFirstAvailableBonus($id,$limit=5) {
        return $this->db->select('user_id,username,first_bonus_status,first_bonus_id,amount,rem_amount,date_of_gh,status')
            ->from('plan')
            ->where('status', 4)
            ->where('first_bonus_status', 1)
            ->where('first_bonus_id', $id)
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->get()->result();
    }

    public function getSecondAvailableBonus($id,$limit=5) {
        return $this->db->select('user_id,username,second_bonus_status,second_bonus_id,amount,rem_amount,date_of_gh,status')
            ->from('plan')
            ->where('status', 4)
            ->where('second_bonus_status', 1)
            ->where('second_bonus_id', $id)
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->get()->result();
    }



    public function get($id) {

        return $this->db->select('p.*, i.title, i.price, i.code, m.method_name, m.account, u.username', FALSE)
            ->from('payment p')
            ->join('purchase_item i', 'i.id = p.upgrade_id')
            ->join('user_payment_method m', 'm.id = p.method_id')
            ->join('users u', 'u.id = p.payer_user_id')
            ->where('p.id', $id)
            ->get()->row(); // can only be 1 at a time of these
    }


    public function getAll(){
        return $this->db->select('id,name,team_link,team_leader,location')
            ->from('teams')
            ->where('status', 1)
            ->order_by('id', 'DESC')
            ->get()->result();
    }


    public function getFull($id) {

        return $this->db->select("p.*, i.title, i.price, i.code, m.method_name, m.account, u1.username payer, concat_ws(' ', u1.first_name, u1.last_name) payer_name, u2.username payee, concat_ws(' ', u2.first_name, u2.last_name) payee_name, u2.email payee_email", FALSE)
            ->from('payment p')
            ->join('purchase_item i', 'i.id = p.upgrade_id')
            ->join('user_payment_method m', 'm.id = p.method_id')
            ->join('users u1', 'u1.id = p.payer_user_id')
            ->join('users u2', 'u2.id = p.payee_user_id')
            ->where('p.id', $id)
            ->get()->row(); // can only be 1 at a time of these
    }

    public function update($id, $data) {
        $n = $this->db->where('id', $id)->update('plan', $data);
        if ($n){
            return true;
        }

    }

    public function updateTimeUp($id, $data) {
        $n =   $this->db->where('payer_user_id', $id)->update('payment', $data);
        if ($n){
            return true;
        }

    }

    public function updateplanmerge($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('plan', $data);

        return TRUE;
    }

    public function updateplanupload($id, $data) {
        $n =   $this->db->where('id', $id)->update('plan', $data);
        if ($n){
            return true;
        }

    }

    public function updateplanapprove($id, $data) {
        $n =   $this->db->where('id', $id)->update('plan', $data);
        if ($n){
            return true;
        }

    }

    public function getPendingSingle($payerId) {
        return $this->db->select('created,expired')
            ->from('payment')
            ->where('payer_user_id', $payerId)
            ->where('approved IS NULL')
            ->where('rejected IS NULL')
            ->where('deleted', 0)
            ->get()->row();  // can only be 1 at a time of these
    }

    public function getPendingSent($payerId) {
        return $this->db->select('p.*, i.title, i.price, m.method_name, m.account', FALSE)
            ->from('payment p')
            ->join('purchase_item i', 'i.id = p.upgrade_id')
            ->join('user_payment_method m', 'm.id = p.method_id')
            ->where('payer_user_id', $payerId)
            ->where('approved IS NULL')
            ->where('rejected IS NULL')
            ->where('p.deleted', 0)
            ->get()->row();  // can only be 1 at a time of these
    }

    public function isPending($payerId, $level) {
        return $this->db->select('p.*, i.title, i.price, m.method_name, m.account', FALSE)
            ->from('payment p')
            ->join('purchase_item i', 'i.id = p.upgrade_id')
            ->join('user_payment_method m', 'm.id = p.method_id')
            ->where('payer_user_id', $payerId)
            ->where('approved IS NULL')
            ->where('rejected IS NULL')
            ->where('p.deleted', 0)
            ->where('i.code', $level)
            ->get()->row(); // can only be 1 at a time of these
    }


}