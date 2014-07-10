<table class="table table-striped">
        <thead>
            <tr>
              <th>{$stats_title}</th>
              <th>{$stats_title_value}</th>
            </tr>
        </thead>
        <tbody>
        {foreach $stats_pedido stat}
          <tr>
            <td>{$stat.title}</td>
            <td><strong>{$stat.value}</strong></td>
          </tr>
        {/foreach}
        </tbody>      
      </table>