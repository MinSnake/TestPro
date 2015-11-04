/**
 Copyright (c) 2008-2010 Ricardo Quesada
 Copyright (c) 2011-2012 cocos2d-x.org
 Copyright (c) 2013-2014 Chukong Technologies Inc.
 Copyright (c) 2008, Luke Benstead.
 All rights reserved.

 Redistribution and use in source and binary forms, with or without modification,
 are permitted provided that the following conditions are met:

 Redistributions of source code must retain the above copyright notice,
 this list of conditions and the following disclaimer.
 Redistributions in binary form must reproduce the above copyright notice,
 this list of conditions and the following disclaimer in the documentation
 and/or other materials provided with the distribution.

 THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

<<<<<<< HEAD
(function(cc) {
    cc.kmVec3 = cc.math.Vec3 = function (x, y, z) {
        if(x && y === undefined){
            this.x = x.x;
            this.y = x.y;
            this.z = x.z;
        } else {
            this.x = x || 0;
            this.y = y || 0;
            this.z = z || 0;
        }
    };

    cc.math.vec3 = function(x, y, z){
        return new cc.math.Vec3(x, y, z);
    };

    var proto = cc.math.Vec3.prototype;

    proto.fill = function (x, y, z) {    // =cc.kmVec3Fill
        if (x && y === undefined) {
            this.x = x.x;
            this.y = x.y;
            this.z = x.z;
        } else {
            this.x = x;
            this.y = y;
            this.z = z;
        }
        return this;
    };

    proto.length = function () {     //=cc.kmVec3Length
        return Math.sqrt(cc.math.square(this.x) + cc.math.square(this.y) + cc.math.square(this.z));
    };

    proto.lengthSq = function () {   //=cc.kmVec3LengthSq
        return cc.math.square(this.x) + cc.math.square(this.y) + cc.math.square(this.z)
    };

    proto.normalize = function () {  //= cc.kmVec3Normalize
        var l = 1.0 / this.length();
        this.x *= l;
        this.y *= l;
        this.z *= l;
        return this;
    };

    proto.cross = function (vec3) {   //= cc.kmVec3Cross
        var x = this.x, y = this.y, z = this.z;
        this.x = (y * vec3.z) - (z * vec3.y);
        this.y = (z * vec3.x) - (x * vec3.z);
        this.z = (x * vec3.y) - (y * vec3.x);
        return this;
    };

    proto.dot = function (vec) {     //= cc.kmVec3Dot
        return (  this.x * vec.x + this.y * vec.y + this.z * vec.z );
    };

    proto.add = function(vec){      //= cc.kmVec3Add
        this.x += vec.x;
        this.y += vec.y;
        this.z += vec.z;
        return this;
    };

    proto.subtract = function (vec) {  // = cc.kmVec3Subtract
        this.x -= vec.x;
        this.y -= vec.y;
        this.z -= vec.z;
        return this;
    };

    proto.transform = function (mat4) {             // = cc.kmVec3Transform
        var x = this.x, y = this.y, z = this.z, mat = mat4.mat;
        this.x = x * mat[0] + y * mat[4] + z * mat[8] + mat[12];
        this.y = x * mat[1] + y * mat[5] + z * mat[9] + mat[13];
        this.z = x * mat[2] + y * mat[6] + z * mat[10] + mat[14];
        return this;
    };

    proto.transformNormal = function(mat4){
        /*
         a = (Vx, Vy, Vz, 0)
         b = (a×M)T
         Out = (bx, by, bz)
         */
        //Omits the translation, only scaling + rotating
        var x = this.x, y = this.y, z = this.z, mat = mat4.mat;
        this.x = x * mat[0] + y * mat[4] + z * mat[8];
        this.y = x * mat[1] + y * mat[5] + z * mat[9];
        this.z = x * mat[2] + y * mat[6] + z * mat[10];
        return this;
    };

    proto.transformCoord = function(mat4){        // = cc.kmVec3TransformCoord
        /*
         a = (Vx, Vy, Vz, 1)
         b = (a×M)T
         Out = 1⁄bw(bx, by, bz)
         */
        var v = new cc.math.Vec4(this.x, this.y, this.z, 1.0);
        v.transform(mat4);
        this.x = v.x / v.w;
        this.y = v.y / v.w;
        this.z = v.z / v.w;
        return this;
    };

    proto.scale = function(scale){             // = cc.kmVec3Scale
        this.x *= scale;
        this.y *= scale;
        this.z *= scale;
        return this;
    };

    proto.equals = function(vec){    // = cc.kmVec3AreEqual
        var EPSILON = cc.math.EPSILON;
        return (this.x < (vec.x + EPSILON) && this.x > (vec.x - EPSILON)) &&
            (this.y < (vec.y + EPSILON) && this.y > (vec.y - EPSILON)) &&
            (this.z < (vec.z + EPSILON) && this.z > (vec.z - EPSILON));
    };

    proto.inverseTransform = function(mat4){   //= cc.kmVec3InverseTransform
        var mat = mat4.mat;
        var v1 = new cc.math.Vec3(this.x - mat[12], this.y - mat[13], this.z - mat[14]);
        this.x = v1.x * mat[0] + v1.y * mat[1] + v1.z * mat[2];
        this.y = v1.x * mat[4] + v1.y * mat[5] + v1.z * mat[6];
        this.z = v1.x * mat[8] + v1.y * mat[9] + v1.z * mat[10];
        return this;
    };

    proto.inverseTransformNormal = function(mat4){   // = cc.kmVec3InverseTransformNormal
        var x = this.x, y = this.y, z = this.z, mat = mat4.mat;
        this.x = x * mat[0] + y * mat[1] + z * mat[2];
        this.y = x * mat[4] + y * mat[5] + z * mat[6];
        this.z = x * mat[8] + y * mat[9] + z * mat[10];
        return this;
    };

    proto.assignFrom = function(vec){
        if(!vec)
            return this;
        this.x = vec.x;
        this.y = vec.y;
        this.z = vec.z;
         return this;
    };

    cc.math.Vec3.zero = function(vec){   // = cc.kmVec3Zero
        vec.x = vec.y = vec.z = 0.0;
        return vec;
    };

    proto.toTypeArray = function(){           //cc.kmVec3ToTypeArray
        var tyArr = new Float32Array(3);
        tyArr[0] = this.x;
        tyArr[1] = this.y;
        tyArr[2] = this.z;
        return tyArr;
    };
})(cc);
=======
cc.kmVec3 = function (x, y, z) {
    this.x = x || 0;
    this.y = y || 0;
    this.z = z || 0;
};

cc.kmVec3Fill = function(pOut, x, y , z){
    if(!pOut)
        return new cc.kmVec3(x, y , z);
    pOut.x = x;
    pOut.y = y;
    pOut.z = z;
    return pOut;
};

cc.kmVec3Length = function(pIn){
    return Math.sqrt(cc.kmSQR(pIn.x) + cc.kmSQR(pIn.y) + cc.kmSQR(pIn.z));
};

cc.kmVec3LengthSq = function(pIn){
    return cc.kmSQR(pIn.x) + cc.kmSQR(pIn.y) + cc.kmSQR(pIn.z)
} ;

cc.kmVec3Normalize = function(pOut,pIn){
    var l = 1.0 / cc.kmVec3Length(pIn);

    pOut.x = pIn.x * l;
    pOut.y = pIn.y * l;
    pOut.z = pIn.z * l;
    return pOut;
};

cc.kmVec3Cross = function(pOut, pV1,pV2){
    pOut.x = (pV1.y * pV2.z) - (pV1.z * pV2.y);
    pOut.y = (pV1.z * pV2.x) - (pV1.x * pV2.z);
    pOut.z = (pV1.x * pV2.y) - (pV1.y * pV2.x);
    return pOut;
};

cc.kmVec3Dot = function(pV1, pV2){
    return (  pV1.x * pV2.x
        + pV1.y * pV2.y
        + pV1.z * pV2.z );
} ;

cc.kmVec3Add = function(pOut, pV1, pV2){
    pOut.x = pV1.x + pV2.x;
    pOut.y = pV1.y + pV2.y;
    pOut.z = pV1.z + pV2.z;
    return pOut;
};

cc.kmVec3Subtract = function(pOut, pV1, pV2){
    pOut.x = pV1.x - pV2.x;
    pOut.y = pV1.y - pV2.y;
    pOut.z = pV1.z - pV2.z;
    return pOut;
};

cc.kmVec3Transform = function(pOut, pV, pM){
    /*
     a = (Vx, Vy, Vz, 1)
     b = (a×M)T
     Out = (bx, by, bz)
     */
    pOut.x = pV.x * pM.mat[0] + pV.y * pM.mat[4] + pV.z * pM.mat[8] + pM.mat[12];
    pOut.y = pV.x * pM.mat[1] + pV.y * pM.mat[5] + pV.z * pM.mat[9] + pM.mat[13];
    pOut.z = pV.x * pM.mat[2] + pV.y * pM.mat[6] + pV.z * pM.mat[10] + pM.mat[14];
    return pOut;
};

cc.kmVec3TransformNormal = function(pOut, pV, pM){
    /*
     a = (Vx, Vy, Vz, 0)
     b = (a×M)T
     Out = (bx, by, bz)
     */
    //Omits the translation, only scaling + rotating
    pOut.x = pV.x * pM.mat[0] + pV.y * pM.mat[4] + pV.z * pM.mat[8];
    pOut.y = pV.x * pM.mat[1] + pV.y * pM.mat[5] + pV.z * pM.mat[9];
    pOut.z = pV.x * pM.mat[2] + pV.y * pM.mat[6] + pV.z * pM.mat[10];
    return pOut;
};

cc.kmVec3TransformCoord = function(pOut,pV,pM){
    /*
     a = (Vx, Vy, Vz, 1)
     b = (a×M)T
     Out = 1⁄bw(bx, by, bz)
     */
    var v = new cc.kmVec4();
    var inV = new cc.kmVec4();
    cc.kmVec4Fill(inV, pV.x, pV.y, pV.z, 1.0);

    cc.kmVec4Transform(v, inV,pM);

    pOut.x = v.x / v.w;
    pOut.y = v.y / v.w;
    pOut.z = v.z / v.w;

    return pOut;
};

cc.kmVec3Scale = function(pOut, pIn, s){
    pOut.x = pIn.x * s;
    pOut.y = pIn.y * s;
    pOut.z = pIn.z * s;

    return pOut;
};

cc.kmVec3AreEqual = function(p1, p2){
    if ((p1.x < (p2.x + cc.kmEpsilon) && p1.x > (p2.x - cc.kmEpsilon)) &&
        (p1.y < (p2.y + cc.kmEpsilon) && p1.y > (p2.y - cc.kmEpsilon)) &&
        (p1.z < (p2.z + cc.kmEpsilon) && p1.z > (p2.z - cc.kmEpsilon))) {
        return 1;
    }

    return 0;
};

cc.kmVec3InverseTransform = function(pOut, pVect,pM){
    var v1 = new cc.kmVec3(pVect.x - pM.mat[12], pVect.y - pM.mat[13],pVect.z - pM.mat[14]);

    pOut.x = v1.x * pM.mat[0] + v1.y * pM.mat[1] + v1.z * pM.mat[2];
    pOut.y = v1.x * pM.mat[4] + v1.y * pM.mat[5] + v1.z * pM.mat[6];
    pOut.z = v1.x * pM.mat[8] + v1.y * pM.mat[9] + v1.z * pM.mat[10];

    return pOut;
};

cc.kmVec3InverseTransformNormal = function(pOut, pVect, pM){
    pOut.x = pVect.x * pM.mat[0] + pVect.y * pM.mat[1] + pVect.z * pM.mat[2];
    pOut.y = pVect.x * pM.mat[4] + pVect.y * pM.mat[5] + pVect.z * pM.mat[6];
    pOut.z = pVect.x * pM.mat[8] + pVect.y * pM.mat[9] + pVect.z * pM.mat[10];

    return pOut;
};

cc.kmVec3Assign = function(pOut,pIn){
    if (pOut == pIn)
        return pOut;

    pOut.x = pIn.x;
    pOut.y = pIn.y;
    pOut.z = pIn.z;
    return pOut;
};

cc.kmVec3Zero = function(pOut){
    pOut.x = 0.0;
    pOut.y = 0.0;
    pOut.z = 0.0;

    return pOut;
};

cc.kmVec3ToTypeArray = function(vecValue){
    if(!vecValue)
        return null;

    var tyArr = new Float32Array(3);
    tyArr[0] = vecValue.x;
    tyArr[1] = vecValue.y;
    tyArr[2] = vecValue.z;
    return tyArr;
};
>>>>>>> f582c68427c6682e16be99cb6b12cec92446801b










