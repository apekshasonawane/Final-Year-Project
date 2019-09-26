package mypkg.nonstopbusticket;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

/**
 * Created by santosh on 1/16/2019.
 */

public class TicketActivity extends AppCompatActivity {
    Button buttonBusCancelTicket;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ticket);

        buttonBusCancelTicket=(Button)findViewById(R.id.buttonBusCancelTicket);
        buttonBusCancelTicket.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i=new Intent(TicketActivity.this,TicketCancelActivity.class);
                startActivity(i);
            }
        });

    }
}
