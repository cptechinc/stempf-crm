<tr>
    <td colspan="2"></td> <td></td> <td>Subtotal</td> <td colspan="4"></td> <td colspan="2" class="text-right">$ <?php echo formatmoney($order->odrsubtot); ?></td> <td></td>
    
</tr>
<tr>
    <td colspan="2"></td> <td></td> <td>Tax</td> <td colspan="4"></td> <td colspan="2" class="text-right">$ <?php echo formatmoney($order->odrtax); ?></td> <td></td>
    
</tr>      
<tr>
    <td colspan="2"></td> <td></td> <td>Freight</td> <td colspan="4"></td> <td colspan="2" class="text-right">$ <?php echo formatmoney($order->odrfrt); ?></td> <td></td>
     
</tr>
<tr>
    <td colspan="2"></td> <td></td> <td>Misc.</td> <td colspan="4"></td><td colspan="2" class="text-right">$ <?php echo formatmoney($order->odrmis); ?></td> <td></td>
    
</tr>
<tr>
    <td colspan="2"></td> <td></td>  <td>Total</td> <td colspan="4"></td> <td colspan="2" class="text-right">$ <?php echo formatmoney($order->odrtotal); ?></td> <td></td>
</tr>
