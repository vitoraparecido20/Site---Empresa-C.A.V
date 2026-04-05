<form action="salvar_recebivel.php" method="POST">
    <label>Cliente:</label><br>
    <input type="text" name="cliente" required placeholder="Nome do cliente ou empresa"><br><br>

    <label>Descrição:</label><br>
    <input type="text" name="descricao" placeholder="Ex: Reserva de vaga"><br><br>

    <label>Valor (R$):</label><br>
    <input type="number" step="0.01" name="valor" required><br><br>

    <label>Data de Vencimento:</label><br>
    <input type="date" name="vencimento" required><br><br>

    <button type="submit">Registrar Recebível</button>
</form>