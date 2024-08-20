<?php 

// صف من نمط abstract من أجل جعله قالب محدد لعمليات التوابع , ترث منه الصفوف الأخرى 
abstract class Database
{
	public $servername='localhost';
	public $username='root';
	public $password='';
	public $dbname='blog_db';
	public $connection;

	//تابع الأتصال بالداتا
	public function connect() {
		$this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

		$this->connection->set_charset('utf8');

		if ($this->connection->connect_error) {
			die($this->connection->connect_error);
		}

		return $this->connection;
	}

	// توابع يتم توصيف تنفيذها ضمن الصفوف الأبناءCRUD 
	abstract public function  listAll();
	abstract public function create($title,$content,$author,$created_at,$updated_at);
	abstract public function read($id);
    abstract public function update($id,$title,$content,$author,$updated_at);
	abstract public function delete();
}

?>