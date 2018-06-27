#include <iostream>
#include <cstdio>
#include <cstdlib>
#include <cmath>
#include <cstring>
#include <string>
#include <vector>
#include <deque>
#include <list>
#include <set>
#include <map>
#include <stack>
#include <queue>
#include <utility>
#include <algorithm>

#define INF 0x3f3f3f3f
#define X first
#define Y second
#define mp make_pair
#define pb push_back
#define MAXN 2005
#define MAXC 100005
#define MAXCSMALL 2005

using namespace std;

typedef long long llint;
typedef pair<int,int> pii;

int N, sorted[MAXC], P[25][MAXC], step, len, small_len[MAXN], Count[MAXN];
char str[MAXC], str_small[MAXN][MAXCSMALL];
pair< pii,int > B[MAXN];

void Read() {
    int i;

    scanf ("%s %d", str, &N);
    len = strlen ( str );
    str[len++] = 1;

    for ( i=0; i<N; ++i ) {
        scanf ("%s", str_small[i] );
        small_len[i] = strlen ( str_small[i] );
    }
}

void Sort ( pair< pii,int > *A ) {
    int i, Len = len+50;

    memset ( Count, 0, sizeof(Count) );
    for ( i=0; i<len; ++i ) {
        ++Count[ A[i].X.Y ];
    }
    for ( i=1; i<Len; ++i ) {
        Count[i] += Count[i-1];
    }
    for ( i=len-1; i>=0; --i ) {
        B[ Count[ A[i].X.Y ]-1 ] = A[i];
        --Count[A[i].X.Y];
    }
    for ( i=0; i<len; ++i ) {
        A[i] = B[i];
    }

    memset ( Count, 0, sizeof(Count) );
    for ( i=0; i<len; ++i ) {
        ++Count[ A[i].X.X ];
    }
    for ( i=1; i<Len; ++i ) {
        Count[i] += Count[i-1];
    }
    for ( i=len-1; i>=0; --i ) {
        B[ Count[A[i].X.X]-1 ] = A[i];
        --Count[A[i].X.X];
    }
    for ( i=0; i<len; ++i ) {
        A[i] = B[i];
    }
}

void Suffix_Array() {
    int i, j, count;
    pair< pii, int > temp[MAXC];

    for ( i=0; i<len; ++i ) {
        P[0][i] = str[i];
    }

    for ( step=1, j=1; j<len; j <<= 1, ++step ) {
        for ( i=0; i<=len; ++i ) {
            temp[i] = mp ( mp ( P[step-1][i], i+j<len ? P[step-1][i+j] : -1 ), i );
        }
        Sort ( temp ) ;
        //sort ( temp, temp+len );

        count = 0;
        P[step][ temp[0].Y ] = 0;
        for ( i=1; i<len; ++i ) {
            if ( temp[i].X.X != temp[i-1].X.X || temp[i].X.Y != temp[i-1].X.Y ) {
                ++count;
            }
            P[step][ temp[i].Y ] = count;
        }
    }
    --step;

    for ( i=0; i<len; ++i ) {
        sorted[i] = temp[i].Y; 
    }
    
}

int Comp ( int x, int y ) {
    int i;

    for ( i=0; i<small_len[y]; ++i ) {
        if ( str_small[y][i] > str[ sorted[x] + i ] ) {
            return -1;
        }
        else if ( str_small[y][i] < str[ sorted[x] + i ] ) {
            return 1;
        }
    }
    return 0;
}

void Solve() {
    int i, lo, hi, mid;

    for ( i=0; i<N; ++i ) {
        lo = 0, hi = len-1;
        while ( lo < hi ) {
            mid = (lo+hi+1) / 2;
            if ( Comp(mid,i) > 0 ) {
                hi = mid-1;
            }
            else {
                lo = mid;
            }
        }

        if ( Comp ( lo, i ) == 0 ) {
            printf ("Y\n");
        }
        else {
            printf ("N\n");
        }
    }

}

int main ( void ) {

    Read();
    Suffix_Array();
    Solve();

    return 0;
}
