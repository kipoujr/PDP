#include <stdio.h>
#include <algorithm>

#define MAXN 10005
#define MAXM 10005

using namespace std;

int N, M, A[MAXN][MAXM], st[MAXM], next[MAXM], prev[MAXM];

void Read() {
  int i, j;
  char c;
  
  scanf ( "%d %d", &N, &M );
  for ( i=1; i<=N; ++i ) {
    for ( j=1; j<=M; ++j ) {
      do {
	scanf ( "%c", &c );
      } while ( c !='.' && c != 'X' );
      A[i][j] = c == '.' ? 1 : 0;
    }
  }
}

void Heights () {
  int i, j;

  for ( j=1; j<=M; ++j ) {
    for ( i=2; i<=N; ++i ) {
      A[i][j] = A[i][j] * ( A[i-1][j] + 1 );
    }
  }
}

//Row i returns the maximum table which has its bottom side parallel to row i
int Row( int i) {
  int j, sz, maxim = -1;
  
  sz = 0;
  for ( j=1; j<=M; ++j ) {
    while ( sz > 0 && A[i][ st[sz] ] > A[i][j] ) {
      next[ st[sz] ] = j;
      --sz;
    }
    st[ ++sz ] = j;
  }
  while ( sz > 0 ) {
    next[ st[sz] ] = M+1;
    --sz;
  }

  //Same for previous
  sz = 0;
  for ( j=M; j>=1; --j ) {
    while ( sz > 0 && A[i][ st[sz] ] > A[i][j] ) {
      prev[ st[sz] ] = j;
      --sz;
    }
    st[ ++sz ] = j;
  }
  while( sz > 0 ) {
    prev[ st[sz] ] = 0;
    --sz;
  }

  for ( j=1; j<=M; ++j ) {
    if ( A[i][j] == 0 ) {
      continue;
    }
    //printf ( "%d %d %d %d\n", i, j, next[j], prev[j] );
    maxim = max ( maxim, next[j] - prev[j] - 1 + A[i][j] );
  }

  return 2*maxim;
}

void Solve() {
  int i, maxim = -1;

  Heights();
  for ( i=1; i<=N; ++i ) {
    maxim = max ( maxim, Row(i) );
  }

  printf ( "%d\n", maxim - 1 );
}

int main() {
  Read();
  Solve();
}
