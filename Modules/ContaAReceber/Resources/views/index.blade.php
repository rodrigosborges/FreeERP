@extends('contaapagar::layouts.master')

@section('css')
<style>
  * {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
  font-family: "Times new Roman", Times, serif;
}

h1 {
  text-transform: uppercase;
}

header {
	display: flex;
	justify-content: space-between;
	width: 100%;
	height: 20%;
}

#total {
	width: 15%;
	height: auto;
	border: 2px solid black;
	border-radius: 1rem;
	margin: 10px;
    overflow: hidden;
}

#total p {
	text-align: center;
	font-size: 2rem;
}

 #novo-button{
	font-size: 2rem;
	text-align: center;
	width: 20%;
	height: auto;
	border: 2px solid black;
	border-radius: 1rem;
	align-self: flex-end;
}

#corpo {
	margin-top: 1%;
	border: 2px solid black;
	width: 100%;
	height: 65%;
	border-radius: 10px;
	padding-top: 1%;
  overflow: auto;
}

/* width em 0 para deixar a barra invísivel.*/
::-webkit-scrollbar {
  width: 0px;
}

#corpo table {
	padding: 0 5%;
	width: 100%;
  margin: 0 auto;
}

#corpo table tr {
    border-bottom-style: groove;
    border-bottom-color: grey;
    border-bottom-width: 1px;
}

#corpo th {
	margin: 0 auto;
	padding: 0 2%;
	font-size: 2rem;
  text-align: center;
}

#corpo td {
	font-size: 1.6rem;
	text-align: center;
  max-width: 15ch;
}
#corpo table th, td {
    padding-bottom: 0.5%;
}

tr:nth-child(even) {
    background: #C6E2FF;
}

section {
  width: 100%;
  height: auto;
  text-align: right;
}

section input, p {
  margin-top: 0.5%;
  font-size: 1.4rem;
  display: inline-block;
  padding: 0.5rem;
}

input[type=checkbox] {
  transform: scale(1.5);
}

</style>
@stop

@section('content')
<body>    


</body>
@stop
