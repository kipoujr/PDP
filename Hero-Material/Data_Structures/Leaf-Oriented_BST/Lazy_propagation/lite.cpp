#include <stdio.h>
#include <algorithm>

using namespace std;

#define LCHILD 2*now
#define RCHILD 2*now+1
#define MAXN 101010

int N,M;

struct node
{
	int on,off;
	bool lazy;
};

node pin[4*MAXN];

void Update(int now,int begin,int end,int from,int to);

void Read()
{
	scanf("%d %d",&N,&M);
}

void Create(int now,int begin,int end)
{
	//    printf("%d to %d is %d\n",begin,end,end-begin+1);
	pin[now].on=0;
	pin[now].off=end-begin+1;
	pin[now].lazy=0;
	int mid=(begin+end)/2;
	if(end!=begin)
		{
			Create(LCHILD,begin,mid);
			Create(RCHILD,mid+1,end);
		}
}

void Propagate(int now,int begin,int end)
{
	//printf("PROPAGATE MOFO!\n");
	if(pin[now].lazy)
		{
			pin[now].lazy=0;

			int mid=(begin+end)/2;

			Update(LCHILD,begin,mid,begin,mid);
			Update(RCHILD,mid+1,end,mid+1,end);
		}
}

void Update(int now,int begin,int end,int from,int to)
{
	if(begin==from && to==end)
		{
			pin[now].off=pin[now].off^pin[now].on;
			pin[now].on=pin[now].off^pin[now].on;
			pin[now].off=pin[now].off^pin[now].on;
			if(to!=from)
				pin[now].lazy=!pin[now].lazy;
			return;
		}

	int mid=(begin+end)/2;

	Propagate(now,begin,end);

	if(to<=mid)
		{
			//printf("I will go only to my left child because %d <= %d \n",to,mid);
			Update(LCHILD,begin,mid,from,to);
		}
	else if(from>mid)
		{
			//printf("I will go only to my right child because %d > %d \n",from,mid);
			Update(RCHILD,mid+1,end,from,to);
		}
	else
		{
			//printf("I will go to both my children because %d > %d and %d <= %d\n",to,mid,from,mid);
			Update(LCHILD,begin,mid,from,mid);
			Update(RCHILD,mid+1,end,mid+1,to);
		}

	pin[now].on=pin[LCHILD].on+pin[RCHILD].on;
	pin[now].off=pin[LCHILD].off+pin[RCHILD].off;
}

node Find(int now,int begin,int end,int from,int to)
{
	if(from==begin && to==end)
		{
			return(pin[now]);
		}

	int mid=(begin+end)/2;

	Propagate(now,begin,end);

	if(to<=mid)
		{
			return(Find(LCHILD,begin,mid,from,to));
		}
	if(from>mid)
		{
			return(Find(RCHILD,mid+1,end,from,to));
		}

	node left=Find(LCHILD,begin,mid,from,mid),right=Find(RCHILD,mid+1,end,mid+1,to);

	node ret;
	ret.on = left.on+right.on;
	ret.off = left.off+right.off;
	ret.lazy = 0;
	return ret;
}

void Solve()
{
	int a,b;
	int op;
	for(int i=0;i<M;++i)
		{
			scanf("%d %d %d",&op,&a,&b);
			if(!op)
				Update(1,0,N-1,a-1,b-1);
			else
				printf("%d\n",Find(1,0,N-1,a-1,b-1).on);
		}
}

int main()
{
	Read();
	Create(1,0,N-1);
	Solve();
	return 0;
}
