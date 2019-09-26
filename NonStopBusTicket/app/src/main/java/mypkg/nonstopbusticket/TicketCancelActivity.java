package mypkg.nonstopbusticket;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

/**
 * Created by santosh on 1/16/2019.
 */

public class TicketCancelActivity extends AppCompatActivity {
    Intent i;
    Bundle b;
    String tid;

    ProgressDialog progressBar;
    JsonArrayRequest jsonArrayRequest ;
    String BusNumber,BusDest,BusDate,BusTime,BusElder,BusChild,BusSenior,BusFare;
    RequestQueue requestQueue ;
    String HTTP_SERVER_URL =Config.CBUS_URL;
    private static String S_URL =Config.CANCEL_URL;

    TextView editTextCTicketID,editTextBusNumber,editTextCDest,editTextCDate,editTextCTime,editTextCElder,editTextCChild,editTextCSenior,editTextCFair;
    Button buttonCancelTicket2;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cancel);

        i=getIntent();
        b=i.getExtras();
        tid=b.getString("tid");

        editTextCTicketID=(TextView)findViewById(R.id.editTextCTicketID);
        editTextBusNumber=(TextView)findViewById(R.id.editTextBusNumber);
        editTextCDest=(TextView)findViewById(R.id.editTextCDest);
        editTextCDate=(TextView)findViewById(R.id.editTextCDate);
        editTextCTime=(TextView)findViewById(R.id.editTextCTime);
        editTextCElder=(TextView)findViewById(R.id.editTextCElder);
        editTextCChild=(TextView)findViewById(R.id.editTextCChild);
        editTextCSenior=(TextView)findViewById(R.id.editTextCSenior);
        editTextCFair=(TextView)findViewById(R.id.editTextCFair);

        progressBar = new ProgressDialog(TicketCancelActivity.this);
        progressBar.setMessage("Please wait..");
        progressBar.setIndeterminate(false);
        progressBar.setCancelable(true);
        progressBar.show();

        editTextCTicketID.setText(tid);

        jsonArrayRequest = new JsonArrayRequest(HTTP_SERVER_URL+"?tid="+tid,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        JSON_PARSE_DATA_AFTER_WEBCALL(response);
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                    }
                });

        requestQueue = Volley.newRequestQueue(TicketCancelActivity.this);
        requestQueue.add(jsonArrayRequest);

        buttonCancelTicket2=(Button)findViewById(R.id.buttonCancelTicket2);
        buttonCancelTicket2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                progressBar.setMessage("Ticket Booking . . .");
                progressBar.setIndeterminate(false);
                progressBar.setCancelable(true);
                progressBar.show();

                RequestQueue queue = Volley.newRequestQueue(TicketCancelActivity.this);
                String response = null;
                final String finalResponse = response;

                final  String ctid, bus_number,destination,ticket_date,ticket_time,total_elder,total_child,total_senior,total_fair;

                ctid=editTextCTicketID.getText().toString();
                bus_number=editTextBusNumber.getText().toString();
                destination=editTextCDest.getText().toString();
                ticket_date=editTextCDate.getText().toString();
                ticket_time=editTextCTime.getText().toString();
                total_elder=editTextCElder.getText().toString();
                total_child=editTextCChild.getText().toString();
                total_senior=editTextCSenior.getText().toString();
                total_fair=editTextCFair.getText().toString();

                StringRequest postRequest = new StringRequest(Request.Method.POST, S_URL,
                        new Response.Listener<String>()
                        {
                            @Override
                            public void onResponse(String response) {
                                progressBar.hide();
                                //Response
                                Toast.makeText(getApplicationContext(), response, Toast.LENGTH_LONG).show();
                                finish();
                            }
                        },
                        new Response.ErrorListener()
                        {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                // error
                                Log.d("ErrorResponse", finalResponse);
                            }
                        }
                ) {
                    @Override
                    protected Map<String, String> getParams()
                    {
                        Map<String, String> params = new HashMap<String, String>();
                        params.put("ctid", ctid);
                        params.put("bus_number", bus_number);
                        params.put("destination", destination);
                        params.put("ticket_date", ticket_date);
                        params.put("ticket_time", ticket_time);
                        params.put("total_elder", total_elder);
                        params.put("total_child",total_child);
                        params.put("total_senior",total_senior);
                        params.put("total_fair",total_fair);

                        return params;
                    }
                };
                postRequest.setRetryPolicy(new DefaultRetryPolicy(0, DefaultRetryPolicy.DEFAULT_MAX_RETRIES, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));
                queue.add(postRequest);
            }
        });
    }

    public void JSON_PARSE_DATA_AFTER_WEBCALL(JSONArray array){
        for(int i = 0; i<array.length(); i++) {

            JSONObject json = null;
            try {
                json = array.getJSONObject(i);

                //Adding bus details name here to show on click event.
                BusNumber=json.getString("bus_number");
                BusDest=json.getString("destination");
                BusDate=json.getString("ticket_date");
                BusTime=json.getString("ticket_time");
                BusFare=json.getString("total_fair");
                BusElder=json.getString("total_elder");
                BusChild=json.getString("total_child");
                BusSenior=json.getString("total_senior");

                editTextCTicketID.setText(tid);
                editTextBusNumber.setText(BusNumber);
                editTextCDest.setText(BusDest);
                editTextCDate.setText(BusDate);
                editTextCTime.setText(BusTime);
                editTextCElder.setText(BusElder);
                editTextCChild.setText(BusChild);
                editTextCSenior.setText(BusSenior);
                editTextCFair.setText(BusFare);
                progressBar.hide();
            }
            catch (JSONException e)
            {
                e.printStackTrace();
            }
        }
    }
}
