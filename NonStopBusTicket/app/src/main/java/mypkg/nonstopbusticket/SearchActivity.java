package mypkg.nonstopbusticket;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.GestureDetector;
import android.view.MotionEvent;
import android.view.View;
import android.widget.ProgressBar;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import org.json.JSONArray;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.List;
import android.widget.Toast;
import com.android.volley.RequestQueue;

public class SearchActivity extends AppCompatActivity {

    List<DataAdapter> DataAdapterClassList;

    RecyclerView recyclerView;

    RecyclerView.LayoutManager recyclerViewlayoutManager;

    RecyclerView.Adapter recyclerViewadapter;

    ProgressBar progressBar;

    JsonArrayRequest jsonArrayRequest ;

    ArrayList<String> BusNumber,BusDest,BusDate,BusTime,BusFare;

    RequestQueue requestQueue ;

    String HTTP_SERVER_URL =Config.BUS_URL;

    View ChildView ;

    int RecyclerViewClickedItemPOS ;

    String dest;
    Bundle b;
    Intent i;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_search);

        i=getIntent();
        b=i.getExtras();
        dest=b.getString("dest2");

        DataAdapterClassList = new ArrayList<>();

        BusNumber = new ArrayList<>();
        BusDest = new ArrayList<>();
        BusDate = new ArrayList<>();
        BusTime = new ArrayList<>();
        BusFare = new ArrayList<>();

        recyclerView = (RecyclerView) findViewById(R.id.recyclerView1);

        progressBar = (ProgressBar) findViewById(R.id.progressBar);

        recyclerView.setHasFixedSize(true);

        recyclerViewlayoutManager = new LinearLayoutManager(this);

        recyclerView.setLayoutManager(recyclerViewlayoutManager);

        // JSON data web call function call from here.
        JSON_WEB_CALL();

        //RecyclerView Item click listener code starts from here.
        recyclerView.addOnItemTouchListener(new RecyclerView.OnItemTouchListener() {

            GestureDetector gestureDetector = new GestureDetector(SearchActivity.this, new GestureDetector.SimpleOnGestureListener() {

                @Override public boolean onSingleTapUp(MotionEvent motionEvent) {

                    return true;
                }

            });
            @Override
            public boolean onInterceptTouchEvent(RecyclerView Recyclerview, MotionEvent motionEvent) {

                ChildView = Recyclerview.findChildViewUnder(motionEvent.getX(), motionEvent.getY());

                if(ChildView != null && gestureDetector.onTouchEvent(motionEvent)) {

                    //Getting RecyclerView Clicked item value.
                    RecyclerViewClickedItemPOS = Recyclerview.getChildAdapterPosition(ChildView);

                    //Printing RecyclerView Clicked item clicked value using Toast Message.
                    Toast.makeText(SearchActivity.this, BusNumber.get(RecyclerViewClickedItemPOS), Toast.LENGTH_LONG).show();

                    Intent i=new Intent(SearchActivity.this,BookActivity.class);
                    Bundle bundle=new Bundle();
                    bundle.putString("busno",BusNumber.get(RecyclerViewClickedItemPOS).toString());
                    bundle.putString("busdest",BusDest.get(RecyclerViewClickedItemPOS).toString());
                    bundle.putString("busdate",BusDate.get(RecyclerViewClickedItemPOS).toString());
                    bundle.putString("bustime",BusTime.get(RecyclerViewClickedItemPOS).toString());
                    bundle.putString("busfare",BusFare.get(RecyclerViewClickedItemPOS).toString());

                    i.putExtras(bundle);
                    startActivity(i);
                }

                return false;
            }

            @Override
            public void onTouchEvent(RecyclerView Recyclerview, MotionEvent motionEvent) {

            }

            @Override
            public void onRequestDisallowInterceptTouchEvent(boolean disallowIntercept) {

            }
        });

    }

    public void JSON_WEB_CALL(){

        jsonArrayRequest = new JsonArrayRequest(HTTP_SERVER_URL+"?dest="+dest,

                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        //Log.d("JSON", response.toString());
                        JSON_PARSE_DATA_AFTER_WEBCALL(response);
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
// Showing error message if something goes wrong.
                        progressBar.setVisibility(View.GONE);
                        Toast.makeText(SearchActivity.this,"No Bus Found",Toast.LENGTH_LONG).show();

                    }
                });

        requestQueue = Volley.newRequestQueue(this);

        requestQueue.add(jsonArrayRequest);
    }

    public void JSON_PARSE_DATA_AFTER_WEBCALL(JSONArray array){

        for(int i = 0; i<array.length(); i++) {

            DataAdapter GetDataAdapter2 = new DataAdapter();

            JSONObject json = null;
            try {
                json = array.getJSONObject(i);

                GetDataAdapter2.setBus_number(json.getString("bus_number"));

                GetDataAdapter2.setDate(json.getString("date"));

                //Adding bus details name here to show on click event.
                BusNumber.add(json.getString("bus_number"));
                BusDest.add(json.getString("destination"));
                BusDate.add(json.getString("date"));
                BusTime.add(json.getString("departure_time"));
                BusFare.add(json.getString("fare"));


                GetDataAdapter2.setTotal_seats(json.getString("total_seats"));

                GetDataAdapter2.setFare(json.getString("fare"));

            }
            catch (JSONException e)
            {

                e.printStackTrace();
            }

            DataAdapterClassList.add(GetDataAdapter2);

        }

        progressBar.setVisibility(View.GONE);

        recyclerViewadapter = new RecyclerViewAdapter(DataAdapterClassList, this);

        recyclerView.setAdapter(recyclerViewadapter);
    }
}