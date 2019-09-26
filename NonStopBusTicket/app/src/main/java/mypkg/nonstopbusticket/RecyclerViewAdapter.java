package mypkg.nonstopbusticket;

/**
 * Created by santosh on 3/15/2019.
 */

import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import java.util.List;
import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;

public class RecyclerViewAdapter extends RecyclerView.Adapter<RecyclerViewAdapter.ViewHolder> {

    Context context;

    List<DataAdapter> dataAdapters;

    public RecyclerViewAdapter(List<DataAdapter> getDataAdapter, Context context){

        super();

        this.dataAdapters = getDataAdapter;
        this.context = context;
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {

        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.cardview, parent, false);

        ViewHolder viewHolder = new ViewHolder(view);

        return viewHolder;
    }

    @Override
    public void onBindViewHolder(ViewHolder viewHolder, int position) {

        DataAdapter dataAdapter =  dataAdapters.get(position);

        viewHolder.TextViewBusNo.setText(dataAdapter.getBus_number());

        viewHolder.TextViewDate.setText(String.valueOf(dataAdapter.getDate()));

        viewHolder.TextViewTotalSeats.setText(dataAdapter.getTotal_seats());

        viewHolder.TextViewFare.setText(dataAdapter.getFare());

    }

    @Override
    public int getItemCount() {

        return dataAdapters.size();
    }

    class ViewHolder extends RecyclerView.ViewHolder{

        public TextView TextViewBusNo;
        public TextView TextViewDate;
        public TextView TextViewTotalSeats;
        public TextView TextViewFare;


        public ViewHolder(View itemView) {

            super(itemView);

            TextViewBusNo = (TextView) itemView.findViewById(R.id.textView2) ;
            TextViewDate = (TextView) itemView.findViewById(R.id.textView4) ;
            TextViewTotalSeats = (TextView) itemView.findViewById(R.id.textView6) ;
            TextViewFare = (TextView) itemView.findViewById(R.id.textView8) ;


        }
    }
}