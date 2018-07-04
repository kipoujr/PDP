#include <cstdio>
#include <algorithm>
#include <vector>

#define MAXN 1000005

using namespace std;

int N, val[4*MAXN], l[4*MAXN], A[MAXN];

void Read();
void Simulate();
void Print();
void Segs ( int v, int x, int y, int qx, int qy, int val );

void LP ( int v, int x, int y ) {
	if ( l[v] ) {
		int mid = (x+y)/2;
		Segs ( 2*v, x, mid, x, mid, l[v] );
		Segs ( 2*v+1, mid+1, y, mid+1, y, l[v] );
		l[v] = 0;
	}
}

void Make_Array(int v, int x, int y) {
	if ( x==y ) {
		A[x] = val[v];
		return;
	}

	int mid = (x+y)/2;

	LP ( v, x, y );

	Make_Array ( 2*v, x, mid );
	Make_Array ( 2*v+1, mid+1, y );
}

void Segs ( int v, int x, int y, int qx, int qy, int value ) {
	if ( x==qx && y==qy ) {
		val[v] += (y-x+1) * value;
		l[v] += value;
		return;
	}

	int mid = (x+y) / 2;

	LP ( v, x, y );

	if ( qy <= mid ) {
		Segs ( 2*v, x, mid, qx, qy, value );
	}
	else if ( qx > mid ) {
		Segs ( 2*v+1, mid+1, y, qx, qy, value );
	}
	else {
		Segs (2*v, x, mid, qx, mid, value );
		Segs (2*v+1, mid+1, y, mid+1, qy, value );
	}

	val[v] = val[2*v] + val[2*v+1];
}

void Add ( int x, int y ) {
	Segs ( 1, 1, N, x, y, 1);
}

int main ( void ) {
	Read();
	Simulate();
	Make_Array(1,1,N);
	Print();
}

void Read() {
	scanf ("%d", &N);
}

void Simulate() {
	int i, a, b, K;

	scanf ("%d", &K);
	for ( i=1; i<=K; ++i ) {
		scanf ("%d %d", &a, &b);
		Add(a,b);
	}
}

void Print() {
	nth_element ( A+1, A+(N+1)/2, A+N+1 );
	printf ("%d\n", A[ (N+1) /2 ] );
}
