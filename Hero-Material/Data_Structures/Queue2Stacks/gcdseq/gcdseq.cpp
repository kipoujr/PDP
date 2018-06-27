#include <bits/stdc++.h>
using namespace std;

#define MAXN 500005

//Two stacks Pu(sh) and Po(p)
//nPu is the length, gPu[i] = gcd(Pu[1], Pu[2], Pu[3], ... Pu[i])
int nPo, nPu, Pu[MAXN], Po[MAXN], gPu[MAXN], gPo[MAXN], A[MAXN];

void Push(int A[], int gA[], int &nA, int x) {
  A[ ++nA ] = x;
  if ( nA == 1 ) gA[ 1 ] = x;
  else gA[ nA ] = __gcd( gA[ nA-1 ], x);
}

void Pop() {
  if ( nPo == 0 ) {
    while( nPu > 0 ) {
        Push(Po, gPo, nPo, Pu[nPu]);
        nPu--;
    }
  }
  --nPo;
}

int main() {
  int N;
  scanf ("%d", &N);
  for (int i=1; i<=N; ++i ) {
    scanf ("%d", &A[i]);
  }

  int l, r=0;
  int ans=0;
  for ( l=1; l<=N; ++l ) {

    if( A[ l ] == 1 ) {
        r = l;
        nPu = nPo = 0;
        continue;
    }
    while ( r<N && __gcd(__gcd(gPu[nPu],gPo[nPo]),A[r+1]) > 1 )
      Push(Pu,gPu,nPu,A[++r]);
    ans = max(ans,r-l+1);
    Pop();
  }

  printf ("%d\n", ans);
}
