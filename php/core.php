<?php // NOTE: 核心php
header("Content-Type:text/plain;charset=utf-8");
#显示最近的错误
function error()
{
  echo "错误->".mysqli_erroe();
}
#mysqli_num_rows()返回结果集中行的数量：mysqli_num_rows(result);
//result type MYSQLI_ASSOC MYSQLI_NUM MYSQLI_BOTH
function connect_to_db($conn,$servername,$username,$password)
{
  $conn = new mysqli($servername,$username,$password);
  if ($conn->connect_error)
  {
  echo "连接失败";
    die("连接失败: " . $conn->connect_error);
  }
  else
  {
    mysqli_select_db($conn,"everydayonesentence");
    return $conn;
  }
}
// NOTE: 从指定数据表选择指定列 列名 表名 resutType模式 是否显示debug信息 使用何种方法打印测试信息
function select_data_from_table($conn,$col_name,$table_name,$fetch_mode,$showDebug,$showDebugMode)
{
  // NOTE: 获取全部 链接 列 表名
  function fetch_all($conn,$col_name,$table_name)
  {
    $sql="SELECT '$col_name' FROM '$table_name'";
    $result=mysqli_query($conn,$sql);
    $array=mysqli_fetch_all($result);
    return $array;
  }
  // NOTE: 获取一行
  function fetch_one_row($conn,$col_name,$table_name)
  {
    $sql="SELECT '$col_name' FROM '$table_name'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    return $row;
  }
  // NOTE: 获取一行作为数字数组或者关联数组
  #返回与读取行匹配的字符串数组。如果结果集中没有更多的行则返回 NULL。
  function fetch_one_array($conn,$col_name,$table_name)
  {
    $sql="SELECT '$col_name' FROM '$table_name'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    return $row;
  }
  #mysqli_fetch_lengths() 函数返回结果集中的字段长度。
  #mysqli_fetch_row(result);
  if($fetch_mode=="fetch_all" && $showDebug=true)
  {
    fetch_all($conn,$col_name,$table_name);
    showlog($result);
  }
  if($fetch_mode=="fetch_all" && $showDebug=false)
  {
    fetch_all($conn,$col_name,$table_name);
    showlog($result);
  }
  if($fetch_mode=="one_line")
  {
    fetch_one_row($conn,$col_name,$table_name);
  }
  if($fetch_mode=="one_line" &&$showDebug==true)
  {
    fetch_one_row($conn,$col_name,$table_name);
    showlog($result);
  }

}

// NOTE: 打印对象值
function showlog($obj,$mode)
{
  if($mode=="" || $pmode=="print")
  {
    print($obj);
  }
  if($mode=="print_r")
  {
    print_r($obj);
  }
  if($mode=="dump")
  {
    var_dump($obj);
  }
}

 ?>
