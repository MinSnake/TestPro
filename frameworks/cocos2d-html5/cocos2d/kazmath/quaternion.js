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
    /**
     * The Quaternion class
     * @param {Number|cc.math.Quaternion} [x=0]
     * @param {Number} [y=0]
     * @param {Number} [z=0]
     * @param {Number} [w=0]
     * @constructor
     */
    cc.math.Quaternion = function (x, y, z, w) {
        if (x && y === undefined) {
            this.x = x.x;
            this.y = x.y;
            this.z = x.z;
            this.w = x.w;
        } else {
            this.x = x || 0;
            this.y = y || 0;
            this.z = z || 0;
            this.w = w || 0;
        }
    };
    cc.kmQuaternion = cc.math.Quaternion;
    var proto = cc.math.Quaternion.prototype;

    /**
     * Sets the conjugate of quaternion to self
     * @param {cc.math.Quaternion} quaternion
     */
    proto.conjugate = function (quaternion) {   //= cc.kmQuaternionConjugate
        this.x = -quaternion.x;
        this.y = -quaternion.y;
        this.z = -quaternion.z;
        this.w = quaternion.w;
        return this;
    };

    /**
     * Returns the dot product of the current quaternion and parameter quaternion
     * @param quaternion
     * @returns {number}
     */
    proto.dot = function(quaternion) {    // = cc.kmQuaternionDot
        // A dot B = B dot A = AtBt + AxBx + AyBy + AzBz
        return (this.w * quaternion.w + this.x * quaternion.x + this.y * quaternion.y + this.z * quaternion.z);
    };

    /**
     * Returns the exponential of the quaternion, this function doesn't implemented.
     * @returns {cc.math.Quaternion}
     */
    proto.exponential = function(){   //=cc.kmQuaternionExp
        return this;
    };

    /**
     * Makes the current quaternion an identity quaternion
     */
    proto.identity = function(){   //=cc.kmQuaternionIdentity
        this.x = 0.0;
        this.y = 0.0;
        this.z = 0.0;
        this.w = 1.0;
        return this;
    };

    /**
     * Inverses the value of current Quaternion
     */
    proto.inverse = function(){           //=cc.kmQuaternionInverse
        var len = this.length();
        if (Math.abs(len) > cc.math.EPSILON) {
            this.x = 0.0;
            this.y = 0.0;
            this.z = 0.0;
            this.w = 0.0;
            return this;
        }

        ///Get the conjugute and divide by the length
        this.conjugate(this).scale(1.0 / len);
        return this;
    };

    /**
     * Returns true if the quaternion is an identity quaternion
     * @returns {boolean}
     */
    proto.isIdentity = function(){     //=cc.kmQuaternionIsIdentity
        return (this.x === 0.0 && this.y === 0.0 && this.z === 0.0 && this.w === 1.0);
    };

    /**
     * Returns the length of the quaternion
     * @returns {number}
     */
    proto.length = function() {       //=cc.kmQuaternionLength
        return Math.sqrt(this.lengthSq());
    };

    /**
     * Returns the length of the quaternion squared (prevents a sqrt)
     * @returns {number}
     */
    proto.lengthSq = function() {   //=cc.kmQuaternionLengthSq
        return this.x * this.x + this.y * this.y + this.z * this.z + this.w * this.w;
    };

    /**
     * Uses current quaternion multiplies other quaternion.
     * @param {cc.math.Quaternion} quaternion
     * @returns {cc.math.Quaternion}
     */
    proto.multiply = function(quaternion) {     //cc.kmQuaternionMultiply
        var x = this.x, y = this.y, z = this.z, w = this.w;
        this.w = w * quaternion.w - x * quaternion.x - y * quaternion.y - z * quaternion.z;
        this.x = w * quaternion.x + x * quaternion.w + y * quaternion.z - z * quaternion.y;
        this.y = w * quaternion.y + y * quaternion.w + z * quaternion.x - x * quaternion.z;
        this.z = w * quaternion.z + z * quaternion.w + x * quaternion.y - y * quaternion.x;
        return this;
    };

    /**
     * Normalizes a quaternion
     * @returns {cc.math.Quaternion}
     */
    proto.normalize = function(){     //=cc.kmQuaternionNormalize
        var length = this.length();
        if (Math.abs(length) <= cc.math.EPSILON)
            throw "current quaternion is an invalid value";
        this.scale(1.0 / length);
        return this;
    };

    /**
     * Rotates a quaternion around an axis and an angle
     * @param {cc.math.Vec3} axis
     * @param {Number} angle
     */
    proto.rotationAxis = function(axis, angle){        //cc.kmQuaternionRotationAxis
        var rad = angle * 0.5, scale = Math.sin(rad);
        this.w = Math.cos(rad);
        this.x = axis.x * scale;
        this.y = axis.y * scale;
        this.z = axis.z * scale;
        return this;
    };

    /**
     *  Creates a quaternion from a rotation matrix
     * @param mat3
     * @returns {*}
     */
    cc.math.Quaternion.rotationMatrix = function (mat3) {        //cc.kmQuaternionRotationMatrix
        if (!mat3)
            return null;

        var x, y, z, w;
        var m4x4 = [], mat = mat3.mat, scale = 0.0;

        /*    0 3 6
         1 4 7
         2 5 8

         0 1 2 3
         4 5 6 7
         8 9 10 11
         12 13 14 15*/
        m4x4[0] = mat[0];
        m4x4[1] = mat[3];
        m4x4[2] = mat[6];
        m4x4[4] = mat[1];
        m4x4[5] = mat[4];
        m4x4[6] = mat[7];
        m4x4[8] = mat[2];
        m4x4[9] = mat[5];
        m4x4[10] = mat[8];
        m4x4[15] = 1;
        var pMatrix = m4x4[0];

        var diagonal = pMatrix[0] + pMatrix[5] + pMatrix[10] + 1;
        if (diagonal > cc.math.EPSILON) {
            // Calculate the scale of the diagonal
            scale = Math.sqrt(diagonal) * 2;

            // Calculate the x, y, x and w of the quaternion through the respective equation
            x = ( pMatrix[9] - pMatrix[6] ) / scale;
            y = ( pMatrix[2] - pMatrix[8] ) / scale;
            z = ( pMatrix[4] - pMatrix[1] ) / scale;
            w = 0.25 * scale;
        } else {
            // If the first element of the diagonal is the greatest value
            if (pMatrix[0] > pMatrix[5] && pMatrix[0] > pMatrix[10]) {
                // Find the scale according to the first element, and double that value
                scale = Math.sqrt(1.0 + pMatrix[0] - pMatrix[5] - pMatrix[10]) * 2.0;

                // Calculate the x, y, x and w of the quaternion through the respective equation
                x = 0.25 * scale;
                y = (pMatrix[4] + pMatrix[1] ) / scale;
                z = (pMatrix[2] + pMatrix[8] ) / scale;
                w = (pMatrix[9] - pMatrix[6] ) / scale;
            }
            // Else if the second element of the diagonal is the greatest value
            else if (pMatrix[5] > pMatrix[10]) {
                // Find the scale according to the second element, and double that value
                scale = Math.sqrt(1.0 + pMatrix[5] - pMatrix[0] - pMatrix[10]) * 2.0;

                // Calculate the x, y, x and w of the quaternion through the respective equation
                x = (pMatrix[4] + pMatrix[1] ) / scale;
                y = 0.25 * scale;
                z = (pMatrix[9] + pMatrix[6] ) / scale;
                w = (pMatrix[2] - pMatrix[8] ) / scale;
            } else {
                // Else the third element of the diagonal is the greatest value

                // Find the scale according to the third element, and double that value
                scale = Math.sqrt(1.0 + pMatrix[10] - pMatrix[0] - pMatrix[5]) * 2.0;

                // Calculate the x, y, x and w of the quaternion through the respective equation
                x = (pMatrix[2] + pMatrix[8] ) / scale;
                y = (pMatrix[9] + pMatrix[6] ) / scale;
                z = 0.25 * scale;
                w = (pMatrix[4] - pMatrix[1] ) / scale;
            }
        }
        return new cc.math.Quaternion(x, y, z, w);
    };

    /**
     * Create a quaternion from yaw, pitch and roll
     * @param yaw
     * @param pitch
     * @param roll
     * @returns {cc.math.Quaternion}
     */
    cc.math.Quaternion.rotationYawPitchRoll = function (yaw, pitch, roll) {     //cc.kmQuaternionRotationYawPitchRoll
        var ex, ey, ez;        // temp half euler angles
        var cr, cp, cy, sr, sp, sy, cpcy, spsy;        // temp vars in roll,pitch yaw

        ex = cc.degreesToRadians(pitch) / 2.0;    // convert to rads and half them
        ey = cc.degreesToRadians(yaw) / 2.0;
        ez = cc.degreesToRadians(roll) / 2.0;

        cr = Math.cos(ex);
        cp = Math.cos(ey);
        cy = Math.cos(ez);

        sr = Math.sin(ex);
        sp = Math.sin(ey);
        sy = Math.sin(ez);

        cpcy = cp * cy;
        spsy = sp * sy;

        var ret = new cc.math.Quaternion();
        ret.w = cr * cpcy + sr * spsy;
        ret.x = sr * cpcy - cr * spsy;
        ret.y = cr * sp * cy + sr * cp * sy;
        ret.z = cr * cp * sy - sr * sp * cy;
        ret.normalize();
        return ret;
    };

    /**
     * Interpolate with other quaternions
     * @param {cc.math.Quaternion} quaternion
     * @param {Number} t
     * @returns {cc.math.Quaternion}
     */
    proto.slerp = function(quaternion, t) {            //=cc.kmQuaternionSlerp
        if (this.x === quaternion.x && this.y === quaternion.y && this.z === quaternion.z && this.w === quaternion.w) {
            return this;
        }
        var ct = this.dot(quaternion), theta = Math.acos(ct), st = Math.sqrt(1.0 - cc.math.square(ct));
        var stt = Math.sin(t * theta) / st, somt = Math.sin((1.0 - t) * theta) / st;
        var temp2 = new cc.math.Quaternion(quaternion);
        this.scale(somt);
        temp2.scale(stt);
        this.add(temp2);
        return this;
    };

    /**
     * Get the axis and angle of rotation from a quaternion
     * @returns {{axis: cc.math.Vec3, angle: number}}
     */
    proto.toAxisAndAngle = function(){    //=cc.kmQuaternionToAxisAngle
        var tempAngle;        // temp angle
        var scale;            // temp vars
        var retAngle, retAxis = new cc.math.Vec3();

        tempAngle = Math.acos(this.w);
        scale = Math.sqrt(cc.math.square(this.x) + cc.math.square(this.y) + cc.math.square(this.z));

        if (((scale > -cc.math.EPSILON) && scale < cc.math.EPSILON)
            || (scale < 2 * Math.PI + cc.math.EPSILON && scale > 2 * Math.PI - cc.math.EPSILON)) {       // angle is 0 or 360 so just simply set axis to 0,0,1 with angle 0
            retAngle = 0.0;
            retAxis.x = 0.0;
            retAxis.y = 0.0;
            retAxis.z = 1.0;
        } else {
            retAngle = tempAngle * 2.0;        // angle in radians
            retAxis.x = this.x / scale;
            retAxis.y = this.y / scale;
            retAxis.z = this.z / scale;
            retAxis.normalize();
        }
         return {axis: retAxis, angle: retAngle};
    };

    /**
     * Scale a quaternion
     * @param {Number} scale
     */
    proto.scale = function(scale) {   //cc.kmQuaternionScale
        this.x *= scale;
        this.y *= scale;
        this.z *= scale;
        this.w *= scale;
        return this;
    };

    /**
     * Assign current quaternion value from a quaternion.
     * @param {cc.math.Quaternion} quaternion
     * @returns {cc.math.Quaternion}  current quaternion
     */
    proto.assignFrom = function(quaternion){     //=cc.kmQuaternionAssign
        this.x = quaternion.x;
        this.y = quaternion.y;
        this.z = quaternion.z;
        this.w = quaternion.w;
        return this;
    };

    /**
     * Adds other quaternion
     * @param {cc.math.Quaternion} quaternion
     * @returns {cc.math.Quaternion}
     */
    proto.add = function(quaternion) {              //cc.kmQuaternionAdd
        this.x += quaternion.x;
        this.y += quaternion.y;
        this.z += quaternion.z;
        this.w += quaternion.w;
        return this;
    };

    /**
     * <p>
     *     Adapted from the OGRE engine!                                                            <br/>
     *     Gets the shortest arc quaternion to rotate this vector to the destination vector.        <br/>
     *     @remarks                                                                                <br/>
     *     If you call this with a destination vector that is close to the inverse                  <br/>
     *     of this vector, we will rotate 180 degrees around the 'fallbackAxis'                     <br/>
     *     (if specified, or a generated axis if not) since in this case ANY axis of rotation is valid.
     * </p>
     * @param {cc.math.Vec3} vec1
     * @param {cc.math.Vec3} vec2
     * @param {cc.math.Vec3} fallback
     * @returns {cc.math.Quaternion}
     */
    cc.math.Quaternion.rotationBetweenVec3 = function(vec1, vec2, fallback) {            //cc.kmQuaternionRotationBetweenVec3
        var v1 = new cc.math.Vec3(vec1), v2 = new cc.math.Vec3(vec2);
        v1.normalize();
        v2.normalize();
        var a = v1.dot(v2), quaternion = new cc.math.Quaternion();

        if (a >= 1.0) {
            quaternion.identity();
            return quaternion;
        }

        if (a < (1e-6 - 1.0)) {
            if (Math.abs(fallback.lengthSq()) < cc.math.EPSILON) {
                quaternion.rotationAxis(fallback, Math.PI);
            } else {
                var axis = new cc.math.Vec3(1.0, 0.0, 0.0);
                axis.cross(vec1);

                //If axis is zero
                if (Math.abs(axis.lengthSq()) < cc.math.EPSILON) {
                    axis.fill(0.0, 1.0, 0.0);
                    axis.cross(vec1);
                }
                axis.normalize();
                quaternion.rotationAxis(axis, Math.PI);
            }
        } else {
            var s = Math.sqrt((1 + a) * 2), invs = 1 / s;
            v1.cross(v2);
            quaternion.x = v1.x * invs;
            quaternion.y = v1.y * invs;
            quaternion.z = v1.z * invs;
            quaternion.w = s * 0.5;
            quaternion.normalize();
        }
        return quaternion;
    };

    /**
     * Current quaternion multiplies a vec3
     * @param {cc.math.Vec3} vec
     * @returns {cc.math.Vec3}
     */
    proto.multiplyVec3 = function(vec){        //=cc.kmQuaternionMultiplyVec3
        var x = this.x, y = this.y, z = this.z, retVec = new cc.math.Vec3(vec);
        var uv = new cc.math.Vec3(x, y, z), uuv = new cc.math.Vec3(x, y, z);
        uv.cross(vec);
        uuv.cross(uv);
        uv.scale((2.0 * q.w));
        uuv.scale(2.0);

        retVec.add(uv);
        retVec.add(uuv);
        return retVec;
    };
})(cc);

=======
/**
 * The Quaternion class
 * @param {Number} x
 * @param {Number} y
 * @param {Number} z
 * @param {Number} w
 * @constructor
 */
cc.kmQuaternion = function (x, y, z, w) {
    this.x = x || 0;
    this.y = y || 0;
    this.z = z || 0;
    this.w = w || 0;
};

///< Returns pOut, sets pOut to the conjugate of pIn
cc.kmQuaternionConjugate = function (pOut, pIn) {
    pOut.x = -pIn.x;
    pOut.y = -pIn.y;
    pOut.z = -pIn.z;
    pOut.w = pIn.w;

    return pOut;
};

///< Returns the dot product of the 2 quaternions
cc.kmQuaternionDot = function (q1, q2) {
    // A dot B = B dot A = AtBt + AxBx + AyBy + AzBz
    return (q1.w * q2.w +
        q1.x * q2.x +
        q1.y * q2.y +
        q1.z * q2.z);
};

///< Returns the exponential of the quaternion
cc.kmQuaternionExp = function (pOut, pIn) {
    //TODO not implement
    //cc.assert(0);
    return pOut;
};

///< Makes the passed quaternion an identity quaternion
cc.kmQuaternionIdentity = function (pOut) {
    pOut.x = 0.0;
    pOut.y = 0.0;
    pOut.z = 0.0;
    pOut.w = 1.0;

    return pOut;
};

///< Returns the inverse of the passed Quaternion
cc.kmQuaternionInverse = function (pOut, pIn) {
    var l = cc.kmQuaternionLength(pIn);
    var tmp = new cc.kmQuaternion();

    if (Math.abs(l) > cc.kmEpsilon) {
        pOut.x = 0.0;
        pOut.y = 0.0;
        pOut.z = 0.0;
        pOut.w = 0.0;
        return pOut;
    }

    ///Get the conjugute and divide by the length
    cc.kmQuaternionScale(pOut,
        cc.kmQuaternionConjugate(tmp, pIn), 1.0 / l);

    return pOut;
};

///< Returns true if the quaternion is an identity quaternion
cc.kmQuaternionIsIdentity = function (pIn) {
    return (pIn.x == 0.0 && pIn.y == 0.0 && pIn.z == 0.0 &&
        pIn.w == 1.0);
};

///< Returns the length of the quaternion
cc.kmQuaternionLength = function (pIn) {
    return Math.sqrt(cc.kmQuaternionLengthSq(pIn));
};

///< Returns the length of the quaternion squared (prevents a sqrt)
cc.kmQuaternionLengthSq = function (pIn) {
    return pIn.x * pIn.x + pIn.y * pIn.y +
        pIn.z * pIn.z + pIn.w * pIn.w;
};

///< Returns the natural logarithm
cc.kmQuaternionLn = function (pOut, pIn) {
    /*
     A unit quaternion, is defined by:
     Q == (cos(theta), sin(theta) * v) where |v| = 1
     The natural logarithm of Q is, ln(Q) = (0, theta * v)
     */
    //assert(0);
    //TODO not implement
    return pOut;
};

///< Multiplies 2 quaternions together
cc.kmQuaternionMultiply = function (pOut, q1, q2) {
    pOut.w = q1.w * q2.w - q1.x * q2.x - q1.y * q2.y - q1.z * q2.z;
    pOut.x = q1.w * q2.x + q1.x * q2.w + q1.y * q2.z - q1.z * q2.y;
    pOut.y = q1.w * q2.y + q1.y * q2.w + q1.z * q2.x - q1.x * q2.z;
    pOut.z = q1.w * q2.z + q1.z * q2.w + q1.x * q2.y - q1.y * q2.x;

    return pOut;
};

///< Normalizes a quaternion
cc.kmQuaternionNormalize = function (pOut, pIn) {
    var length = cc.kmQuaternionLength(pIn);
    if(Math.abs(length) <= cc.kmEpsilon)
        throw "cc.kmQuaternionNormalize(): pIn is an invalid value";
    cc.kmQuaternionScale(pOut, pIn, 1.0 / length);

    return pOut;
};

///< Rotates a quaternion around an axis
cc.kmQuaternionRotationAxis = function (pOut, pV, angle) {
    var rad = angle * 0.5;
    var scale = Math.sin(rad);

    pOut.w = Math.cos(rad);
    pOut.x = pV.x * scale;
    pOut.y = pV.y * scale;
    pOut.z = pV.z * scale;

    return pOut;
};

///< Creates a quaternion from a rotation matrix
cc.kmQuaternionRotationMatrix = function (pOut, pIn) {
    /*
     Note: The OpenGL matrices are transposed from the description below
     taken from the Matrix and Quaternion FAQ

     if ( mat[0] > mat[5] && mat[0] > mat[10] )  {    // Column 0:
     S  = sqrt( 1.0 + mat[0] - mat[5] - mat[10] ) * 2;
     X = 0.25 * S;
     Y = (mat[4] + mat[1] ) / S;
     Z = (mat[2] + mat[8] ) / S;
     W = (mat[9] - mat[6] ) / S;
     } else if ( mat[5] > mat[10] ) {            // Column 1:
     S  = sqrt( 1.0 + mat[5] - mat[0] - mat[10] ) * 2;
     X = (mat[4] + mat[1] ) / S;
     Y = 0.25 * S;
     Z = (mat[9] + mat[6] ) / S;
     W = (mat[2] - mat[8] ) / S;
     } else {                        // Column 2:
     S  = sqrt( 1.0 + mat[10] - mat[0] - mat[5] ) * 2;
     X = (mat[2] + mat[8] ) / S;
     Y = (mat[9] + mat[6] ) / S;
     Z = 0.25 * S;
     W = (mat[4] - mat[1] ) / S;
     }
     */
    var x, y, z, w;
    var m4x4 = [];
    var scale = 0.0;
    var diagonal = 0.0;

    if (!pIn) {
        return null;
    }

    /*    0 3 6
     1 4 7
     2 5 8

     0 1 2 3
     4 5 6 7
     8 9 10 11
     12 13 14 15*/

    m4x4[0] = pIn.mat[0];
    m4x4[1] = pIn.mat[3];
    m4x4[2] = pIn.mat[6];
    m4x4[4] = pIn.mat[1];
    m4x4[5] = pIn.mat[4];
    m4x4[6] = pIn.mat[7];
    m4x4[8] = pIn.mat[2];
    m4x4[9] = pIn.mat[5];
    m4x4[10] = pIn.mat[8];
    m4x4[15] = 1;
    var pMatrix = m4x4[0];

    diagonal = pMatrix[0] + pMatrix[5] + pMatrix[10] + 1;

    if (diagonal > cc.kmEpsilon) {
        // Calculate the scale of the diagonal
        scale = Math.sqrt(diagonal) * 2;

        // Calculate the x, y, x and w of the quaternion through the respective equation
        x = ( pMatrix[9] - pMatrix[6] ) / scale;
        y = ( pMatrix[2] - pMatrix[8] ) / scale;
        z = ( pMatrix[4] - pMatrix[1] ) / scale;
        w = 0.25 * scale;
    } else {
        // If the first element of the diagonal is the greatest value
        if (pMatrix[0] > pMatrix[5] && pMatrix[0] > pMatrix[10]) {
            // Find the scale according to the first element, and double that value
            scale = Math.sqrt(1.0 + pMatrix[0] - pMatrix[5] - pMatrix[10]) * 2.0;

            // Calculate the x, y, x and w of the quaternion through the respective equation
            x = 0.25 * scale;
            y = (pMatrix[4] + pMatrix[1] ) / scale;
            z = (pMatrix[2] + pMatrix[8] ) / scale;
            w = (pMatrix[9] - pMatrix[6] ) / scale;
        }
        // Else if the second element of the diagonal is the greatest value
        else if (pMatrix[5] > pMatrix[10]) {
            // Find the scale according to the second element, and double that value
            scale = Math.sqrt(1.0 + pMatrix[5] - pMatrix[0] - pMatrix[10]) * 2.0;

            // Calculate the x, y, x and w of the quaternion through the respective equation
            x = (pMatrix[4] + pMatrix[1] ) / scale;
            y = 0.25 * scale;
            z = (pMatrix[9] + pMatrix[6] ) / scale;
            w = (pMatrix[2] - pMatrix[8] ) / scale;
        } else {
            // Else the third element of the diagonal is the greatest value

            // Find the scale according to the third element, and double that value
            scale = Math.sqrt(1.0 + pMatrix[10] - pMatrix[0] - pMatrix[5]) * 2.0;

            // Calculate the x, y, x and w of the quaternion through the respective equation
            x = (pMatrix[2] + pMatrix[8] ) / scale;
            y = (pMatrix[9] + pMatrix[6] ) / scale;
            z = 0.25 * scale;
            w = (pMatrix[4] - pMatrix[1] ) / scale;
        }
    }

    pOut.x = x;
    pOut.y = y;
    pOut.z = z;
    pOut.w = w;

    return pOut;
};

///< Create a quaternion from yaw, pitch and roll
cc.kmQuaternionRotationYawPitchRoll = function (pOut, yaw, pitch, roll) {
    var ex, ey, ez;        // temp half euler angles
    var cr, cp, cy, sr, sp, sy, cpcy, spsy;        // temp vars in roll,pitch yaw

    ex = cc.kmDegreesToRadians(pitch) / 2.0;    // convert to rads and half them
    ey = cc.kmDegreesToRadians(yaw) / 2.0;
    ez = cc.kmDegreesToRadians(roll) / 2.0;

    cr = Math.cos(ex);
    cp = Math.cos(ey);
    cy = Math.cos(ez);

    sr = Math.sin(ex);
    sp = Math.sin(ey);
    sy = Math.sin(ez);

    cpcy = cp * cy;
    spsy = sp * sy;

    pOut.w = cr * cpcy + sr * spsy;

    pOut.x = sr * cpcy - cr * spsy;
    pOut.y = cr * sp * cy + sr * cp * sy;
    pOut.z = cr * cp * sy - sr * sp * cy;

    cc.kmQuaternionNormalize(pOut, pOut);

    return pOut;
};

///< Interpolate between 2 quaternions
cc.kmQuaternionSlerp = function (pOut, q1, q2, t) {
    /*float CosTheta = Q0.DotProd(Q1);
     float Theta = acosf(CosTheta);
     float SinTheta = sqrtf(1.0f-CosTheta*CosTheta);

     float Sin_T_Theta = sinf(T*Theta)/SinTheta;
     float Sin_OneMinusT_Theta = sinf((1.0f-T)*Theta)/SinTheta;

     Quaternion Result = Q0*Sin_OneMinusT_Theta;
     Result += (Q1*Sin_T_Theta);

     return Result;*/

    if (q1.x == q2.x &&
        q1.y == q2.y &&
        q1.z == q2.z &&
        q1.w == q2.w) {

        pOut.x = q1.x;
        pOut.y = q1.y;
        pOut.z = q1.z;
        pOut.w = q1.w;

        return pOut;
    }

    var ct = cc.kmQuaternionDot(q1, q2);
    var theta = Math.acos(ct);
    var st = Math.sqrt(1.0 - cc.kmSQR(ct));

    var stt = Math.sin(t * theta) / st;
    var somt = Math.sin((1.0 - t) * theta) / st;

    var temp = new cc.kmQuaternion(), temp2 = new cc.kmQuaternion();
    cc.kmQuaternionScale(temp, q1, somt);
    cc.kmQuaternionScale(temp2, q2, stt);
    cc.kmQuaternionAdd(pOut, temp, temp2);

    return pOut;
};

///< Get the axis and angle of rotation from a quaternion
cc.kmQuaternionToAxisAngle = function (pIn, pAxis, pAngle) {
    var tempAngle;        // temp angle
    var scale;            // temp vars

    tempAngle = Math.acos(pIn.w);
    scale = Math.sqrt(cc.kmSQR(pIn.x) + cc.kmSQR(pIn.y) + cc.kmSQR(pIn.z));

    if (((scale > -cc.kmEpsilon) && scale < cc.kmEpsilon)
        || (scale < 2 * cc.kmPI + cc.kmEpsilon && scale > 2 * cc.kmPI - cc.kmEpsilon)) {       // angle is 0 or 360 so just simply set axis to 0,0,1 with angle 0
        pAngle = 0.0;

        pAxis.x = 0.0;
        pAxis.y = 0.0;
        pAxis.z = 1.0;
    } else {
        pAngle = tempAngle * 2.0;        // angle in radians

        pAxis.x = pIn.x / scale;
        pAxis.y = pIn.y / scale;
        pAxis.z = pIn.z / scale;
        cc.kmVec3Normalize(pAxis, pAxis);
    }
};

///< Scale a quaternion
cc.kmQuaternionScale = function (pOut, pIn, s) {
    pOut.x = pIn.x * s;
    pOut.y = pIn.y * s;
    pOut.z = pIn.z * s;
    pOut.w = pIn.w * s;

    return pOut;
};

cc.kmQuaternionAssign = function (pOut, pIn) {
    pOut.x = pIn.x;
    pOut.y = pIn.y;
    pOut.z = pIn.z;
    pOut.w = pIn.w;

    return pOut;
};

cc.kmQuaternionAdd = function (pOut, pQ1, pQ2) {
    pOut.x = pQ1.x + pQ2.x;
    pOut.y = pQ1.y + pQ2.y;
    pOut.z = pQ1.z + pQ2.z;
    pOut.w = pQ1.w + pQ2.w;

    return pOut;
};

/** Adapted from the OGRE engine!

 Gets the shortest arc quaternion to rotate this vector to the destination
 vector.
 @remarks
 If you call this with a dest vector that is close to the inverse
 of this vector, we will rotate 180 degrees around the 'fallbackAxis'
 (if specified, or a generated axis if not) since in this case
 ANY axis of rotation is valid.
 */
cc.kmQuaternionRotationBetweenVec3 = function (pOut, vec1, vec2, fallback) {
    var v1 = new cc.kmVec3(), v2 = new cc.kmVec3();
    var a;

    cc.kmVec3Assign(v1, vec1);
    cc.kmVec3Assign(v2, vec2);

    cc.kmVec3Normalize(v1, v1);
    cc.kmVec3Normalize(v2, v2);

    a = cc.kmVec3Dot(v1, v2);

    if (a >= 1.0) {
        cc.kmQuaternionIdentity(pOut);
        return pOut;
    }

    if (a < (1e-6 - 1.0)) {
        if (Math.abs(cc.kmVec3LengthSq(fallback)) < cc.kmEpsilon) {
            cc.kmQuaternionRotationAxis(pOut, fallback, cc.kmPI);
        } else {
            var axis = new cc.kmVec3();
            var X = new cc.kmVec3();
            X.x = 1.0;
            X.y = 0.0;
            X.z = 0.0;

            cc.kmVec3Cross(axis, X, vec1);

            //If axis is zero
            if (Math.abs(cc.kmVec3LengthSq(axis)) < cc.kmEpsilon) {
                var Y = new cc.kmVec3();
                Y.x = 0.0;
                Y.y = 1.0;
                Y.z = 0.0;

                cc.kmVec3Cross(axis, Y, vec1);
            }

            cc.kmVec3Normalize(axis, axis);
            cc.kmQuaternionRotationAxis(pOut, axis, cc.kmPI);
        }
    } else {
        var s = Math.sqrt((1 + a) * 2);
        var invs = 1 / s;

        var c = new cc.kmVec3();
        cc.kmVec3Cross(c, v1, v2);

        pOut.x = c.x * invs;
        pOut.y = c.y * invs;
        pOut.z = c.z * invs;
        pOut.w = s * 0.5;

        cc.kmQuaternionNormalize(pOut, pOut);
    }
    return pOut;
};

cc.kmQuaternionMultiplyVec3 = function (pOut, q, v) {
    var uv = new cc.kmVec3(), uuv = new cc.kmVec3(), qvec = new cc.kmVec3();

    qvec.x = q.x;
    qvec.y = q.y;
    qvec.z = q.z;

    cc.kmVec3Cross(uv, qvec, v);
    cc.kmVec3Cross(uuv, qvec, uv);

    cc.kmVec3Scale(uv, uv, (2.0 * q.w));
    cc.kmVec3Scale(uuv, uuv, 2.0);

    cc.kmVec3Add(pOut, v, uv);
    cc.kmVec3Add(pOut, pOut, uuv);

    return pOut;
};
>>>>>>> f582c68427c6682e16be99cb6b12cec92446801b












