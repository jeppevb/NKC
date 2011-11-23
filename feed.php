<?php header('Content-type: application/atom+xml; charset=UTF-8');?>
<?xml version='1.0' encoding='utf-8' ?>
<feed xml:lang="da-DK" xmlns="http://www.w3.org/2005/Atom"> 
     <title>Nordjysk Kampsportscenter Nyheder</title> 
     <subtitle>Seneste nyheder fra nordjyskkampsport.dk</subtitle>
     <link href="http://nordjyskkampsport.dk/feed" rel="self"/> 
     <updated><?php echo date(DATE_RFC3339); ?></updated>
     <author> 
          <name>Nordjysk Kampsportscenter</name>
          <email>info@nordjyskkampsport.dk</email>
     </author>
     <id>tag:nordjyskkampsport.dk,2011:http://nordjyskkampsport.dk/feed</id>
     
<?php
	 require_once 'includes/dbqueryconfig.php';
	 $query = 'SELECT news.id,title,meta_desc as subtitle,admins.login as author,created as posted FROM news inner join admins on admins.id = news.admin_id order by created desc limit 25';
	 $result = mysql_query($query, $qcon);
     $i = 0;
     while($row = mysql_fetch_array($result))
       {
          if ($i > 0) {
               echo "</entry>";
           }

           $articleDate = $row['posted'];
           $articleDateRfc3339 = date(DATE_RFC3339,strtotime($articleDate));
           echo "<entry>";
           echo "<title>";
           echo $row['title'];
           echo "</title>";
           echo "<link type='text/html' href='http://nordjyskkampsport.dk/nyheder/" . $row['id'] . "'/>";
           echo "<id>";
           echo "tag:nordjyskkampsport.dk,2011:http://nordjyskkampsport.dk/nyheder/".$row['id'];
           echo "</id>";
           echo "<updated>";
           echo $articleDateRfc3339;
           echo "</updated>";
           echo "<author>";
           echo "<name>";
           echo $row['author'];
           echo "</name>";
           echo "</author>"; 
           echo "<summary>";
           echo $row['subtitle'];
           echo "</summary>";

           $i++;
     }		
?>
	</entry>
</feed>