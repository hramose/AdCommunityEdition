~~~

TTransaction::open(CFC_SIS);
$repository = new HRepository('CfcPacotesAlunos');
$retorno = $repository->count('valor');
print_r($retorno);
echo "<br/>";
$retorno = $repository->sum('valor');
print_r($retorno);
echo "<br/>";
$retorno = $repository->max('valor');
print_r($retorno);
echo "<br/>";
$retorno = $repository->min('valor');
print_r($retorno);
echo "<br/>";
$retorno = $repository->avg('valor');
print_r($retorno);
echo "<br/>";
TTransaction::close();

~~~