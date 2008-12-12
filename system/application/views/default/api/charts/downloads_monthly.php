<?php $rand = rand();?>
var chart<?php echo $rand?> = new FusionCharts("<?php echo $base_url?>flash/charts/Column3D.swf", "ChartId", "<?php echo $height?>", "<?php echo $width?>", "0", "0"); chart<?php echo $rand?>.setDataXML("");chart<?php echo $rand?>.render("chart_data");

<chart caption='Past 7 Days Downloads' xAxisName='Day' yAxisName='Uploads' showValues='0' decimals='0' formatNumberScale='0'>
<set label='<?php $d='-6'; echo date('D', strtotime($d.' days'))?>' value='<?php echo $this->db->get_where('downloads', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM')))->num_rows()?>'/>
<set label='<?php $d='-5'; echo date('D', strtotime($d.' days'))?>' value='<?php echo $this->db->get_where('downloads', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM')))->num_rows()?>'/>
<set label='<?php $d='-4'; echo date('D', strtotime($d.' days'))?>' value='<?php echo $this->db->get_where('downloads', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM')))->num_rows()?>'/>
<set label='<?php $d='-3'; echo date('D', strtotime($d.' days'))?>' value='<?php echo $this->db->get_where('downloads', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM')))->num_rows()?>'/>
<set label='<?php $d='-2'; echo date('D', strtotime($d.' days'))?>' value='<?php echo $this->db->get_where('downloads', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM')))->num_rows()?>'/>
<set label='<?php $d='-1'; echo date('D', strtotime($d.' days'))?>' value='<?php echo $this->db->get_where('downloads', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM')))->num_rows()?>'/>
<set label='<?php $d='-6'; echo date('D', strtotime('today'))?>' value='<?php echo $this->db->get_where('downloads', array('time >' => strtotime('today 12:00 AM'), 'time <' => strtotime('today 11:59:59 PM')))->num_rows()?>'/>
</chart>